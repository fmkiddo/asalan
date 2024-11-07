<?php
namespace App\Controllers;

use App\Libraries\AssetType;
use App\Libraries\CURLRequestMapper;
use App\Libraries\RuleSets;
use App\Libraries\LangLoader;

class Home extends BaseController {
    
    
    private $pageMap;
    private $ruleSets;
    
    protected $is_dashboard = TRUE;
    
    /**
     * 
     * @return array
     */
    private function getDashboardConfig (): array {
        $cookieData = unserialize (get_cookie (__SYS_PUBLIC_COOKIEKEY__));
        return $cookieData['config'];
    }
    
    /**
     * 
     * @return bool
     */
    private function isSideBarHidden (): bool {
        $config = $this->getDashboardConfig ();
        return $config['hidden'];
    }
    
    /**
     * 
     * @return string
     */
    private function getSidebarColor (): string {
        $config = $this->getDashboardConfig ();
        $color  = 'dark';
        if (array_key_exists ('sidebar', $config)) $color = $config['sidebar'];
        return $color;
    }
    
    /**
     * 
     * @return string
     */
    private function getTopbarColor (): string {
        $config = $this->getDashboardConfig ();
        $color  = 'default';
        if (array_key_exists('navigator', $config)) $color = $config['navigator'];
        if ($color === 'default') $color = '';
        else $color = "navbar-{$color}";
        return $color;
    }
    
    /**
     * 
     * @return array
     */
    private function getSessionData () {
        $sessData   = array ();
        $this->__getSessionData(__SYS_SESSION_KEY__, $sessData);
        return unserialize (base64_decode ($sessData));
    }
    
    /**
     * 
     * @param string $part
     * @return boolean
     */
    private function canAccess ($part) {
        return TRUE;
    }
    
    /**
     * 
     * @return string
     */
    private function getUsername () {
        $sessionData    = $this->getSessionData ();
        return $sessionData['logged']['user'];
    }
    
    /**
     * 
     * @return array
     */
    private function getProfileData (): array {
        $sessData   = $this->getSessionData ();
        return $sessData['logged']['profile'];
    }
    
    /**
     * 
     * @return string
     */
    private function getUserFirstname () {
        $profile    = $this->getProfileData ();
        if (trim ($profile['user-fname']) === '') return $this->getUsername ();
        return $profile['user-fname'];
    }
    
    private function getUserFullname () {
        $profile    = $this->getProfileData ();
        $firstname  = $profile['user-fname'];
        if ($firstname === '') return 'Not available';
        else return "{$profile['user-fname']} {$profile['user-mname']} {$profile['user-lname']}";
    }
    
    /**
     * 
     * @param string $urname
     * @param array $viewPaths
     */
    private function loadPage ($urname, $viewPaths=array ()) {
        $sideBarIconOnly    = (!$this->isSideBarHidden ()) ? '' : 'sidebar-icon-only';
        $selectedLocale     = $this->__getLocale ();
        $langLoader         = new LangLoader ($selectedLocale);
        
        $notifs             = array (
            
        );
        
        $messages           = array (
            
        );
        
        $this->addViewPaths ($viewPaths)
            ->addViewData ('brand_logo', $this->__getClientLogoURL ())
            ->addViewData ('urname', $urname)
            ->addViewData ('appTitle', lang ('Dashboard.title', [date ('d M Y')], $selectedLocale))
            ->addViewData ('theme', $this->getSidebarColor ())
            ->addViewData ('topbar', $this->getTopbarColor ())
            ->addViewData ('sidebar', $sideBarIconOnly)
            ->addViewData ('sidebar_theme', "sidebar-{$this->getSidebarColor ()}")
            ->addViewData ('csrf_name', csrf_token ())->addViewData ('csrf_data', csrf_hash())
            ->addViewData ('fullname', $this->getUserFullname ())
            ->addViewData ('topbar', array ($langLoader->getLanguage ('topbar', $urname)))
            ->addViewData ('sidebar', array ($langLoader->getLanguage ('nav')))
            ->addViewData ('config', array ($langLoader->getLanguage ('settings')))
            ->addViewData ('notifs', $notifs)
            ->addViewData ('notif_count', count ($notifs))
            ->addViewData ('messages', $messages)
            ->addViewData ('msgs_count', count ($messages))
            ->addAssetResource ('assets/vendors/sweetalert2-11.14.4/css/sweetalert2.css')
            ->addAssetResource ('assets/vendors/datatables-2.1.6/css/datatables.css')
            ->addAssetResource ('assets/css/dashboard.css')
            ->addAssetResource ('assets/vendors/sweetalert2-11.14.4/js/sweetalert2.all.js', AssetType::SCRIPT)
            ->addAssetResource ('assets/vendors/datatables-2.1.6/js/datatables.js', AssetType::SCRIPT)
            ->addAssetResource ('assets/js/dashboard.bundle.js', AssetType::SCRIPT);
    }
    
    private function loadProfileData () {
        $blank_urpict   = TRUE ? 'blank' : '';
        $this->addViewData ('blank_pict', $blank_urpict)
                ->addViewData ('username', $this->getUsername ())
                ->addViewData ('target_uuid', $this->getUserUUID ())
                ->addViewData ('phone', $this->getProfileData ()['user-phone'])
                ->addViewData ('email', $this->getProfileData ()['user-email']);
    }
    
    private function processPost () {
        if (!$this->request->is ('post')) return;
        $post   = $this->request->getPost ();
        $rt     = explode ('|', $post['request-type']);
        $router = $rt[0];
        $type   = $rt[1];
        $rules  = $this->ruleSets->getRuleSets ($router);
        if (!$this->validate ($rules)) {
            
        } else {
            $mapper     = new CURLRequestMapper ();
            $json       = $mapper->getCURLparams ($router, $this->request);
            $api_target = $mapper->getTargetAPI ($router);
            if (!($json && $api_target)) ;
            else {
                $post       = $this->request->getPost ();
                $curlOpts   = [
                    'auth'      => [
                        $this->__readLicFile(),
                        '',
                        'basic'
                    ],
                    'headers'   => [
                        'Content-Type'  => 'application/json',
                        'Accept'        => 'application/json',
                        'User-Agent'    => $this->request->getUserAgent ()
                    ],
                    'json'      => $json
                ];
                
                $method     = "get";
                $url        = $this->__getServerURL ("{$api_target}?atom={$this->getUserUUID ()}");
                if ($type === 'edit') {
                    $segment    = $post['user-uuid'];
                    $method     = 'put';
                    $url        = $this->__getServerURL ("{$api_target}/{$segment}?atom={$this->getUserUUID ()}");
                } elseif ($type === 'new') $method = 'post';
                
                $response       = $this->sendRequest ($url, $curlOpts, $method);
                $json_output    = json_decode ($response->getBody (), TRUE);
                
                if ($router === 'profile' && $json_output['status'] === 200) {
                    $sessData   = $this->getSessionData ();
                    $profile    = $this->getProfileData ();
                    foreach ($profile as $k => $v) $profile[$k] = $json[$k];
                    $sessData['logged']['profile'] = $profile;
                    $this->__setSessionData (
                        array (
                            __SYS_SESSION_KEY__ => base64_encode (serialize ($sessData))
                        )
                    );
                    
                    $imageFile  = $this->request->getFile ("input-urpic");
                }
            }
        }
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Controllers\BaseController::__initComponents()
     */
    protected function __initComponents () {
        parent::__initComponents ();
        $this->ruleSets = new RuleSets ();
        $this->addHelper ('text');
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Controllers\BaseController::index()
     */
    public function index (): string {
        $render = '';
        if (!$this->__isReady ()) $this->response->redirect ($this->__getSiteURL ('setup'));
        else {
            if (!$this->__is_public_cookies_set()) {
                $publicData = [
                    'locale'    => $this->appConfig->defaultLocale,
                    'config'    => [
                        'sidebar'   => 'dark',
                        'navigator' => 'light',
                        'hidden'    => FALSE
                    ]
                ];
                $cookie     = cookie (__SYS_PUBLIC_COOKIEKEY__, serialize ($publicData));
                set_cookie ($cookie);
            }
            
            $this->pageMap = new \App\Libraries\PageMapping ();
            $this->__initSession ();
            if (!$this->__isSessionSet()) $this->response->redirect ($this->__getSiteURL ("{$this->__getLocale()}/welcome"));
            else {
                $path   = explode ('/', $this->request->getPath ());
                if (count ($path) < 2) {
                    $this->response->redirect ($this->__getSiteURL ("{$this->__getLocale()}/dashboard?alv=welcome"));
                    return '';
                }
                
                $get    = $this->request->getGet ();
                $route  = $get['alv'];
                if ($route === 'sign-out') {
                    $this->__destroySession();
                    $this->response->redirect ($this->__getSiteURL ());
                    return "";
                }
                
                $this->processPost ();
                
                $urname         = $this->getUserFirstname();
                
                $part   = $this->pageMap->mapRoute ($route);
                if (!$part) $part = 'not-found';
                
                if (!$this->canAccess ($part)) $part = 'cannot-access';
                
                $viewPaths  = [
                    'tpl-html',
                    'tpl-header',
                    'dashboard/dashboard-topbar',
                    'dashboard/dashboard-navigation',
                    "dashboard/{$part}",
                    'dashboard/dashboard-footer',
                ];
                
                $this->loadPage ($urname, $viewPaths);
                
                switch ($part) {
                    default:
                        break;
                    case 'user-detail':
                        $this->loadProfileData ();
                        break;
                }
                
                $render = $this->renderView ();
            }
        }
        return $render;
    }
    
    public function configChanger () {
        if (!$this->request->is ('post') || $this->request->header("Content-Type")->getValue () !== 'application/json') {
            $this->__initSession ();
            $urname     = $this->getUsername ();
            $viewPaths  = [
                'tpl-html',
                'tpl-header',
                'dashboard/dashboard-topbar',
                'dashboard/dashboard-navigation',
                "dashboard/not-found",
                'dashboard/dashboard-footer',
            ];
            
            $this->loadPage ($urname, $viewPaths);
            return $this->renderView ();
        }
        
        $json   = json_decode ($this->request->getBody (), TRUE);
        $updateConfig   = TRUE;
        if (!array_key_exists ('change', $json)) $updateConfig = FALSE;
        
        if ($updateConfig) {
            $type   = $json['change']['type'];
            $updateConfig = ($type === 'theme' || $type === 'topbar' || $type === 'minimized');
            
            if (!$updateConfig) 
                $response = array (
                    'status'    => 404,
                    'error'     => 404,
                    'messages'  => [
                        'error'     => 'The page you requested is not found!'
                    ] 
                );
            else {
                $configUpdate   = $json['change']['value'];
                if ($type === 'theme') $configName  = 'sidebar';
                elseif ($type === 'topbar') $configName = 'navigator';
                else $configName = 'hidden';
                $this->__set_public_cookie_data ($configName, $configUpdate);
                
                $response   = array (
                    'status'    => 200,
                    'error'     => NULL,
                    'messages'  => [
                        'success'   => 'Config data updated!'
                    ]
                );
            }
        }
        $this->response->setHeader ('Content-Type', 'application/json');
        $this->response->setJSON ($response);
        $this->response->send ();
    }
}
