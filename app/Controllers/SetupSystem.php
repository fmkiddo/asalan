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
                    $this->addViewData ('sdata', $json['data']['payload']);
                    $this->addViewPaths ('tpl-html')->addViewPaths ('tpl-header')
                        ->addViewPaths ('setup/setup-system')->addViewPaths ('tpl-footer');
                }
            }
            
            if (array_key_exists ('serverdata', $post)) {
                /**
                $serverdata = explode ('$', $post['serverdata']);
                $data       = hex2bin ($serverdata[0]);
                $pubKey     = hex2bin ($serverdata[1]);
                
                if (!$this->__decrypt_server_data ($data, $pubKey, $serverdata)) ;
                else {
                    $code           = base64_decode ($serverdata['data0']);
                    $csrfTokenName  = "crosssite_{$code}";
                    $csrfCookieName = "crosssite_{$code}_cookies";
                    $this->addViewPaths ('setup/setup-env')
                        ->addViewData ('environment', (array_key_exists('input-isdevelopment', $post) ? 'development' : 'production'))
                        ->addViewData ('system_url', $post['input-newurl'])
                        ->addViewData ('system_index', (array_key_exists ('input-useindexphp', $post) ? 'index.php' : ''))
                        ->addViewData ('csrf_token', $csrfTokenName)
                        ->addViewData ('csrf_cookie', $csrfCookieName)
                        ->addViewData ('session_driver', 'CodeIgniter\Session\Handlers\FileHandler')
                        ->addViewData ('session_cookie_name', '');
                    $envData        = $this->renderView ();
                    $licData        = "{$serverdata['data1']}#{$serverdata['data0']}";
                    if (write_file (__SYS_ENVIRONMENT_FILE__, $envData, 'wb') &&
                            write_file (__SYS_LICENSE_KEY_FILE__, $licData, 'wb'))
                        $this->response->redirect ($this->__getBaseURL ());
                }
                return ""; **/
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