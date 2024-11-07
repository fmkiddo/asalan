<?php
namespace App\Controllers;


use App\Libraries\AssetType;

class SetupSystem extends BaseController {
    
    private function __decrypt_server_data (string $cipherText, string $akey, &$output): bool {
        $encryption = new \Config\Encryption ();
        $encryption->driver = 'Sodium';
        $encryption->cipher = 'XChaCha20-Poly1305';
        $encryption->key    = $akey;
        
        $encryptor  = \Config\Services::encrypter ($encryption);
        $data   = '';
        try {
            $data = $encryptor->decrypt ($cipherText);
        } catch (\CodeIgniter\Encryption\Exceptions\EncryptionException $exception) {
            return FALSE;
        }
        
        $output   = unserialize ($data);
        return TRUE;
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Controllers\BaseController::__initComponents()
     */
    protected function __initComponents() {
        parent::__initComponents ();
        $this->addHelper ('filesystem');
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Controllers\BaseController::index()
     */
    public function index(): string {
        if ($this->__isReady()) {
            $this->response->redirect ($this->__getSiteURL ());
            return "";
        } elseif ($this->request->is ('get'))
            $this->addViewPaths ('tpl-html')->addViewPaths ('tpl-header')
                ->addViewPaths ('setup/setup-welcome')->addViewPaths ('tpl-footer');
        else {
            $post   = $this->request->getPost ();
            if (array_key_exists ('input-licensee', $post)) {
                $rules  = [
                    'input-licensee'    => [
                        'rules'             => 'required',
                        'errors'            => [
                            'required'          => ''
                        ]
                    ],
                    'input-licensecode' => [
                        'rules'             => 'required',
                        'errors'            => [
                            'required'          => ''
                        ]
                    ]
                ];
                
                if (!$this->validate($rules)) {
                    $this->response->redirect ($this->__getSiteURL ('setup'));
                    return "";
                } else {
                    $opts   = [
                        'headers'   => [
                            'Content-Type'  => 'application/json',
                            'Accept'        => 'application/json'
                        ],
                        'json'      => [
                            'code'  => $post['input-licensee'],
                            'sn'    => $post['input-licensecode']
                        ]
                    ];
                    $response   = $this->sendRequest ($this->__getServerURL ('uniqore/validator'), $opts, 'post');
                    $json       = json_decode ($response->getBody (), TRUE);
                    if ($json['status'] !== 200) $message = $json['messages']['error'];
                    else {
                        $jsonData   = $json['data'];
                        $payloads   = unserialize (base64_decode ($jsonData['payload']));
                        $this->addViewData ('sdata0', $payloads['data0']);
                        $this->addViewData ('sdata1', base64_encode (serialize ($payloads['data1'])));
                        $this->addViewPaths ('tpl-html')->addViewPaths ('tpl-header')
                            ->addViewPaths ('setup/setup-system')->addViewPaths ('tpl-footer');
                    }
                }
            }
            
            if (array_key_exists ('serverdata', $post)) {
                $rules  = [
                    'input-newurl'      => [
                        'rules'             => 'required',
                        'errors'            => [
                            'required'          => ''
                        ]
                    ],
                    'input-newadmin'    => [
                        'rules'             => 'required',
                        'errors'            => [
                            'required'          => ''
                        ]
                    ],
                    'input-newapswd'    => [
                        'rules'             => 'required',
                        'errors'            => [
                            'required'          => ''
                        ]
                    ],
                    'input-newcpswd'    => [
                        'rules'             => 'required|matches[input-newapswd]',
                        'errors'            => [
                            'matches'           => ''
                        ]
                    ]
                ];
                
                if (!$this->validate ($rules)) {
                    $this->response->redirect ($this->__getSiteURL ('setup'));
                    return "";
                } else {
                    $serverdata = explode ('$', $post['serverdata']);
                    $data       = hex2bin ($serverdata[0]);
                    $pubKey     = hex2bin ($serverdata[1]);
                    if (!$this->__decrypt_server_data ($data, $pubKey, $serverdata)) ;
                    else {
                        $auth       = "{$serverdata['data1']}#{$serverdata['data0']}";
                        $curlOpts   = [
                            'delay'     => 500,
                            'auth'      => [
                                $auth,
                                '',
                                'basic'
                            ],
                            'headers'   => [
                                'Accept'        => 'application/json',
                                'Content-Type'  => 'application/json',
                                'User-Agent'    => $this->request->getUserAgent ()
                            ],
                            'json'      => []
                        ];
                        
                        $json   = [
                            'controlcode'           => 'control-admin',
                            'controlname'           => 'Administrators',
                            'control-canapprove'    => TRUE,
                            'control-canremove'     => TRUE,
                            'control-cansend'       => TRUE
                        ];
                        
                        $curlOpts['json']   = $json;
                        $response   = $this->sendRequest ($this->__getServerURL ('controller'), $curlOpts, 'post');
                        $response   = json_decode ($response->getBody (), TRUE);
                        
                        if ($response['status'] !== 200) {
                            $this->response->redirect ($this->__getBaseURL ());
                            return "";
                        } 
                        
                        $data       = $response['data'];
                        $payload    = unserialize (base64_decode ($data['payload']));
                        $group_id   = $payload['returnid'];
                        
                        $json       = [
                            'group-id'          => $group_id,
                            'group-privileges'  => 'all'
                        ];
                        $curlOpts['json']   = $json;
                        $response   = $this->sendRequest ($this->__getServerURL ('acl'), $curlOpts, 'post');
                        $response   = json_decode ($response->getBody (), TRUE);
                        
                        if ($response['status'] !== 200) {
                            $this->response->redirect ($this->__getBaseURL ());
                            return "";
                        } 
                        
                        $json       = [
                            'newuser-groupid'   => $group_id,
                            'newuser-name'      => $post['input-newadmin'],
                            'newuser-email'     => '',
                            'newuser-password'  => $post['input-newapswd'],
                        ];
                        
                        $curlOpts['json']   = $json;
                        $response   = $this->sendRequest ($this->__getServerURL ('users'), $curlOpts, 'post');
                        $response   = json_decode ($response->getBody (), TRUE);
                        
                        if ($response['status'] !== 200) {
                            $this->response->redirect ($this->__getBaseURL ());
                            return "";
                        }
                        
                        $data       = $response['data'];
                        $payload    = unserialize (base64_decode ($data['payload']));
                        $userid     = $payload['returnid'];
                        $json       = [
                            'user-id'       => $userid,
                            'user-fname'    => '',
                            'user-mname'    => '',
                            'user-lname'    => '',
                            'user-addr1'    => '',
                            'user-addr2'    => '',
                            'user-phone'    => '',
                            'user-email'    => '',
                            'user-image'    => [
                                'image-name'        => '',
                                'image-ext'         => '',
                                'image-mime'        => '',
                                'image-contents'    => ''
                            ],
                        ];
                        
                        $curlOpts['json']   = $json;
                        $response   = $this->sendRequest ($this->__getServerURL('user-profile'), $curlOpts, 'post');
                        $response   = json_decode ($response->getBody(), TRUE);
                        
                        if ($response['status'] !== 200) {
                            $this->response->redirect ($this->__getBaseURL ());
                            return "";
                        }
                        
                        $code           = base64_decode ($serverdata['data0']);
                        $fix            = explode ('_', $code)[0];
                        $csrfTokenName  = "crosssite_{$code}";
                        $csrfCookieName = "crosssite_{$code}_cookies";
                        $sessionCookie  = "session_{$fix}_cookies";
                        $cookiePrefix   = "osam_";
                        
                        $extras     = unserialize (base64_decode ($post['extras']));
                        $brandURL   = "assets/imgs/brand-logo.{$extras[1]}";
                        
                        $systemURL  = $post['input-newurl'];
                        $domain     = parse_url ($systemURL);
                        
                        $this->addViewPaths ('setup/setup-env')
                            ->addViewData ('environment', (array_key_exists('input-isdevelopment', $post) ? 'development' : 'production'))
                            ->addViewData ('system_url', $systemURL)
                            ->addViewData ('cookie_prefix', $cookiePrefix)
                            ->addViewData ('cookie_domain', $domain['host'])
                            ->addViewData ('brand_url', $brandURL)
                            ->addViewData ('system_index', (array_key_exists ('input-useindexphp', $post) ? 'index.php' : ''))
                            ->addViewData ('csrf_token', $csrfTokenName)
                            ->addViewData ('csrf_cookie', $csrfCookieName)
                            ->addViewData ('session_driver', 'CodeIgniter\Session\Handlers\FileHandler')
                            ->addViewData ('session_cookie_name', $sessionCookie);
                        $envData    = $this->renderView ();
                        $lic        = bin2hex ("{$serverdata['data1']}#{$serverdata['data0']}");
                        
                        $this->addViewPaths ('setup/setup-licfile')
                            ->addViewData ('licdata', "hex2bin:{$lic}");
                        $licData    = $this->renderView ();
                        
                        if (write_file (__SYS_ENVIRONMENT_FILE__, $envData, 'wb') &&
                                write_file (__SYS_LICENSE_KEY_FILE__, $licData, 'wb') &&
                                write_file ("./{$brandURL}", $extras[0], 'wb'))
                            $this->response->redirect ($this->__getBaseURL ());
                        return "";
                    }
                }
            }
        } 
        
        $this->addAssetResource ('assets/css/setup.css')
                ->addAssetResource ('assets/vendors/jquery-inputmask-1.14.16/jquery.mask.js', AssetType::SCRIPT)
                ->addAssetResource ('assets/js/setup.js', AssetType::SCRIPT);
        $message = '';
        $this->addViewData('appTitle', 'Asset Management System | Setup')->addViewData ('response', $message)
                ->addViewData ('csrf_name', csrf_token ())->addViewData ('csrf_data', csrf_hash());
        return $this->renderView ();
    }
    
}