<?php
namespace App\Controllers;


use App\Libraries\MessageOfTheDay;

class Welcome extends BaseController {
    
    /**
     * {@inheritDoc}
     * @see \App\Controllers\BaseController::index()
     */
    public function index (): string {
        $render = '';
        if (!$this->__isReady ()) $this->response->redirect ($this->__getSiteURL ());
        else {
            $this->__initSession();
            if ($this->__isSessionSet()) $this->response->redirect ($this->__getSiteURL ());
            else {
                if ($this->request->is ('post')) {
                    $rules      = [
                        'input-username'    => [
                            'rules'             => 'required',
                            'errors'            => [
                                'required'          => ''
                            ]
                        ],
                        'input-password'    => [
                            'rules'             => 'required',
                            'errors'            => [
                                'required'          => ''
                            ]
                        ]
                    ];
                    if (!$this->validate ($rules)) ;
                    else {
                        $post       = $this->request->getPost ();
                        $lic        = $this->__readLicFile();
                        
                        $curlOpts   = [
                            'auth'      => [
                                $lic,
                                '',
                                'basic',
                            ],
                            'headers'   => [
                                'Content-Type'  => 'application/json',
                                'Accept'        => 'application/json'
                            ],
                        ];
                        
                        $response   = $this->sendRequest ($this->__getServerURL('osam/users'), $curlOpts, 'get');
                        $response   = json_decode ($response->getBody (), TRUE);
                        if ($response['status'] === 200) {
                            $payload    = unserialize (base64_decode ($response['data']['payload']));
                            $theUser   = FALSE;
                            foreach ($payload as $user)
                                if ($user['username'] === $post['input-username'] ||
                                    $user['email'] === $post['input-username']) {
                                        $theUser    = $user;
                                        break;
                                    }
                            
                            if (!$theUser) ;
                            else {
                                $hash       = $theUser['password'];
                                $password   = $post['input-password'];
                                if (!password_verify ($password, $hash)) ;
                                else {
                                    $baseUUID   = base64_encode ($theUser['uuid']);
                                    $response   = $this->sendRequest ($this->__getServerURL("osam/user-profile/{$baseUUID}"), $curlOpts, 'get');
                                    $response   = json_decode ($response->getBody (), TRUE);
                                    
                                    $profile    = [];
                                    if (array_key_exists ('data', $response)) {
                                        $data       = $response['data'];
                                        $payload    = unserialize (base64_decode ($data['payload']))[0];
                                        $profile    = [
                                            'user-fname'    => $payload['fname'],
                                            'user-mname'    => $payload['mname'],
                                            'user-lname'    => $payload['lname'],
                                            'user-addr1'    => $payload['addr1'],
                                            'user-addr2'    => $payload['addr2'],
                                            'user-phone'    => $payload['phone'],
                                            'user-email'    => $payload['email'],
                                        ];
                                    }
                                    
                                    $userInfo   = [
                                        'logged'    => [
                                            'uuid'      => $theUser['uuid'],
                                            'user'      => $theUser['username'],
                                            'acl'       => [
                                                'code'      => $theUser['group_code'],
                                                'name'      => $theUser['group_name']
                                            ],
                                            'profile'   => $profile,
                                        ]
                                    ];
                                    $sessionData    = [
                                        __SYS_SESSION_KEY__ => base64_encode (serialize ($userInfo))
                                    ];
                                    $this->__initSession ();
                                    $this->__setSessionData($sessionData);
                                    $this->response->redirect ($this->__getSiteURL ());
                                    return "";
                                }
                            }
                        }
                    }
                }
                $MOTD   = new MessageOfTheDay ();
                $viewPaths  = [
                    'tpl-html',
                    'tpl-header',
                    'login',
                    'tpl-footer'
                ];
                
                $this->addViewPaths ($viewPaths)
                    ->addViewData ('lang', ($this->__getLocale() === 'en' ? 'gb' : $this->__getLocale()))
                    ->addViewData ('brand_url', $this->__getClientLogoURL ())
                    ->addViewData ('appTitle', lang ('Welcome.title', [], $this->__getLocale()))
                    ->addViewData ('messageOfTheDay', $MOTD->getMOTD($this->__getLocale ()))
                    ->addViewData ('csrf_name', csrf_token ())->addViewData ('csrf_data', csrf_hash());
                $render = $this->renderView ();
            }
        }
        return $render;
    }
    
}