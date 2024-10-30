<?php
namespace App\Controllers;

use App\Libraries\AssetType;

class Home extends BaseController {
    
    private $fileRoute  = [
        'welcome'   => 'frontpage'
    ];
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
                        'navigator' => 'light'
                    ]
                ];
                $cookie     = cookie (__SYS_PUBLIC_COOKIEKEY__, serialize ($publicData));
                set_cookie ($cookie);
            }
            
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
                
                $sessionData    = [];
                $this->__getSessionData(__SYS_SESSION_KEY__, $sessionData);
                $sessionData    = unserialize (base64_decode($sessionData));
                $urname         = (trim ($sessionData['logged']['profile']['user-fname']) === '') ? 
                                    $sessionData['logged']['user'] : $sessionData['logged']['profile']['user-fname'];
                
                $part   = $this->fileRoute[$route];
                $viewPaths  = [
                    'tpl-html',
                    'tpl-header',
                    'dashboard/dashboard-navigation',
                    'dashboard/dashboard-control',
                    "dashboard/{$part}",
                    'dashboard/dashboard-footer',
                ];
                
                $this->addViewPaths ($viewPaths)
                    ->addViewData ('brand_logo', $this->__getClientLogoURL ())
                    ->addViewData ('urname', $urname)
                    ->addAssetResource ('assets/js/dashboard.bundle.js', AssetType::SCRIPT);
                $render = $this->renderView ();
            }
        }
        return $render;
    }
}
