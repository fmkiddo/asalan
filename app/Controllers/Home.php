<?php
namespace App\Controllers;

use App\Libraries\AssetType;

class Home extends BaseController {
    
    private $pageMap;
    
    protected $is_dashboard = TRUE;
    
    private function getDashboardConfig (): array {
        $cookieData = unserialize (get_cookie (__SYS_PUBLIC_COOKIEKEY__));
        return $cookieData['config'];
    }
    
    private function isSideBarHidden (): bool {
        $config = $this->getDashboardConfig ();
        return $config['hidden'];
    }
    
    private function getSidebarColor (): string {
        $config = $this->getDashboardConfig ();
        $color  = 'dark';
        if (array_key_exists ('sidebar', $config)) $color = $config['sidebar'];
        return $color;
    }
    
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
     * @param string $part
     * @return boolean
     */
    private function canAccess ($part) {
        return TRUE;
    }
    
    /**
     * 
     * @return string|mixed
     */
    private function getUsername () {
        $sessionData    = [];
        $this->__getSessionData(__SYS_SESSION_KEY__, $sessionData);
        $sessionData    = unserialize (base64_decode($sessionData));
        $urname         = (trim ($sessionData['logged']['profile']['user-fname']) === '') ?
                            $sessionData['logged']['user'] : $sessionData['logged']['profile']['user-fname'];
        return $urname;
    }
    
    /**
     * 
     * @param string $urname
     * @param array $viewPaths
     */
    private function loadPage ($urname, $viewPaths=array ()) {
        $sideBarIconOnly = (!$this->isSideBarHidden ()) ? '' : 'sidebar-icon-only';
        $this->addViewPaths ($viewPaths)
            ->addViewData ('brand_logo', $this->__getClientLogoURL ())
            ->addViewData ('urname', $urname)
            ->addViewData ('appTitle', lang ('Dashboard.title', [date ('d M Y')], $this->__getLocale()))
            ->addViewData ('theme', $this->getSidebarColor ())
            ->addViewData ('topbar', $this->getTopbarColor ())
            ->addViewData ('sidebar', $sideBarIconOnly)
            ->addViewData ('sidebar_theme', "sidebar-{$this->getSidebarColor ()}")
            ->addAssetResource ('assets/vendors/sweetalert2-11.14.4/css/sweetalert2.css')
            ->addAssetResource ('assets/vendors/datatables-2.1.6/css/datatables.css')
            ->addAssetResource ('assets/css/dashboard.css')
            ->addAssetResource ('assets/vendors/sweetalert2-11.14.4/js/sweetalert2.all.js', AssetType::SCRIPT)
            ->addAssetResource ('assets/vendors/datatables-2.1.6/js/datatables.js', AssetType::SCRIPT)
            ->addAssetResource ('assets/js/dashboard.bundle.js', AssetType::SCRIPT);
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Controllers\BaseController::index()
     */
    public function index (): string {
        $render = '';
        if (!$this->__isReady ()) $this->response->redirect ($this->__getSiteURL ('osam/setup'));
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
                
                $urname         = $this->getUsername ();
                
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
                
                $blank_urpict   = TRUE ? 'blank' : '';
                $this->loadPage ($urname, $viewPaths);
                $this->addViewData('blank_pict', $blank_urpict);
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
                $this->__set_public_cookie_data($configName, $configUpdate);
                
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
