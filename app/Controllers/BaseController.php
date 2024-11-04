<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\AssetType;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\CURLRequest;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller {
    
    private $viewPaths;
    private $pageData;
    private $parser;
    private $serverConfig;
    
    /**
     * 
     * @var CURLRequest
     */
    private $curl;
    private $session;
    private $locale;
    
    protected $is_dashboard   = FALSE;
    
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];
    
    protected $appConfig;

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;
    
    protected function __isReady (): bool {
        $env    = new File (__SYS_ENVIRONMENT_FILE__);
        $lic    = new File (__SYS_LICENSE_KEY_FILE__);
        return (file_exists ($env->getPathname ()) && file_exists ($lic->getPathname ()));
    }
    
    protected function __getServerURL (string $relativePath='') {
        $url    = "{$this->serverConfig->server_url}{$this->serverConfig->infix_url}";
        $url    .=  "{$relativePath}";
        return $url;
    }
    
    protected function __getClientLogoURL () {
        return $this->serverConfig->brandLogoURL;
    }
    
    protected function __getSiteURL (string $relativePath='') {
        $url    = '';
        if (!$this->__isReady()) $url    = base_url (__SYS_URL_PREFIX__ . "/index.php/{$relativePath}");
        else {
            $url    = site_url ();
            if (strpos ($url, __SYS_URL_PREFIX__)) $url .= $relativePath;
            else $url .= __SYS_URL_PREFIX__ . "/{$relativePath}";
        }
        return $url;
    }
    
    protected function __getBaseURL (string $relativePath='') {
        $url    = base_url ();
        if (strpos ($url, __SYS_URL_PREFIX__)) $url .= $relativePath;
        else $url .= __SYS_URL_PREFIX__ . "/{$relativePath}";
        return $url;
    }
    
    protected function __readLicFile () {
        $file       = new File (__SYS_LICENSE_KEY_FILE__);
        $contents   = file_get_contents ($file->getPathname ());
        $lic        = explode (':', $contents);
        return $lic[1] ($lic[2]);
    }

    /**
     * 
     * Method to instantiate additional components upon
     * class instantiation. You can add more controller resources
     * use this method.
     */
    protected function __initComponents () {
        $this->addAssetResource ('assets/vendors/bootstrap-5.3.3/css/bootstrap.css')
            ->addAssetResource ('assets/vendors/materialdesignicons-7.4.47/css/materialdesignicons.css')
            ->addAssetResource ('assets/vendors/jquery-3.7.1/jquery-3.7.1.js', AssetType::SCRIPT)
            ->addAssetResource ('assets/vendors/bootstrap-5.3.3/js/bootstrap.bundle.js', AssetType::SCRIPT)
            ->addViewData ('siteURL', $this->__getSiteURL ());
    }
    
    protected function __isSessionSet (): bool {
        if ($this->session === NULL) return FALSE;
        else return !($this->session->get (__SYS_SESSION_KEY__) === NULL);
    }
    
    /**
     * 
     * @return $this
     */
    protected function __initSession () {
        $this->session  = \Config\Services::session ();
        return $this;
    }
    
    /**
     * 
     * @param string $name
     * @param array $sessionData
     * @return $this
     */
    protected function __getSessionData ($name, &$sessionData) {
        $sessionData = $this->session->get ($name);
        return $this;
    }
    
    /**
     * 
     * @param array|string $sessionData
     * @return $this
     */
    protected function __setSessionData ($sessionData) {
        if ($this->session === NULL) $this->initSession ();
        $this->session->set ($sessionData);
        return $this;
    }
    
    /**
     * 
     * @return $this
     */
    protected function __destroySession () {
        $this->session->destroy ();
        return $this;
    }
    
    /**
     * 
     * @param array|string $data
     * @return $this
     */
    protected function __setFlashdata ($data) {
        $this->session->setFlashdata ($data);
        return $this;
    }
    
    /**
     * 
     * @param string $name
     * @param array $flashdata
     * @return \App\Controllers\BaseController
     */
    protected function __getFlashdata ($name, &$flashdata) {
        $flashdata = $this->session->getFlashdata($name);
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    protected function __getLocale () {
        return $this->locale;
    }
    
    protected function __is_public_cookies_set (): bool {
        return !(get_cookie(__SYS_PUBLIC_COOKIEKEY__) === NULL);
    }
    
    protected function __set_public_cookie_data ($name, $value) {
        $globCookieVal = unserialize (get_cookie(__SYS_PUBLIC_COOKIEKEY__));
        if ($name === 'locale') $globCookieVal[$name] = $value;
        else $globCookieVal['config'][$name]    = $value;
        $cookie = cookie (__SYS_PUBLIC_COOKIEKEY__, serialize ($globCookieVal));
        set_cookie ($cookie);
    }
    
    /**
     * 
     * Convinient method to add one resource to the controller's asset.
     * $type default to STYLE type when not provided.
     * 
     * @param string $assetURL
     * @param AssetType $type
     * @return $this
     */
    protected function addAssetResource (string $assetURL, AssetType $type=AssetType::STYLE) {
        if ($type === AssetType::SCRIPT) {
            if (!array_key_exists ('scripts', $this->pageData)) $this->pageData['scripts']   = [];
            array_push ($this->pageData['scripts'], ['url' => $assetURL]);
        } else {
            if (!array_key_exists ('styles', $this->pageData)) $this->pageData['styles'] = [];
            array_push ($this->pageData['styles'], ['url' => $assetURL]);
        }
        return $this;
    }
    
    /**
     * 
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    protected function addViewData (string $name, mixed $value) {
        $this->pageData[$name]  = $value;
        return $this;
    }
    
    /**
     * 
     * @param string|array $helper
     * @return $this
     */
    protected function addHelper (string|array $helper) {
        if (is_string ($helper)) array_push ($this->helpers, $helper);
        else
            foreach ($helper as $helpername) array_push ($this->helpers, $helpername);
        return $this;
    }
    
    /**
     * 
     * @param string|array $pathToView
     * @return $this
     */
    protected function addViewPaths ($pathToView) {
        if (is_string ($pathToView)) array_push ($this->viewPaths, $pathToView);
        else 
            foreach ($pathToView as $viewPath) array_push ($this->viewPaths, $viewPath); 
        return $this;
    }
    
    /**
     * Method to render view. It will accumulate all page data and views
     * and translate it to HTML string to be sent to user's browser for display
     * 
     * @return string
     */
    protected function renderView (): string {
        $this->addViewData('baseURL', $this->__getBaseURL ())
            ->addViewData('charset', $this->appConfig->charset)
            ->addViewData('locale', $this->locale)
            ->addViewData('year', date ('Y'));
        $this->parser->setData ($this->pageData);
        $rendered = '';
        foreach ($this->viewPaths as $viewPath) $rendered .= $this->parser->render ($viewPath, $this->pageData);
        
        // clear views and view data after being rendered
        $this->viewPaths    = [];
        $this->pageData     = [];
        return $rendered;
    }
    
    protected function sendRequest ($url, $options, $method='get'): ResponseInterface {
        return $this->curl->$method ($url, $options);
    }
    
    /**
     * @return void
     */
    public function initController (
            RequestInterface $request, 
            ResponseInterface $response, 
            LoggerInterface $logger) {
        // Do Not Edit This Line
        parent::initController ($request, $response, $logger);
        $this->addHelper ('url')->addHelper ('cookie');
        $this->appConfig    = config ('App');
        $this->serverConfig = config ('Server');
        $this->curl         = \Config\Services::curlrequest ();
        $this->parser       = \Config\Services::parser ();
        $this->viewPaths    = [];
        $this->pageData     = [];
        $this->__initComponents ();
        $isSetup    = $this->__isReady() ? 'false' : 'true';
        $this->addAssetResource ('assets/css/asalan.css')
            ->addAssetResource ('assets/js/asalan.js', AssetType::SCRIPT)
            ->addViewData ('setup', $isSetup)
            ->addViewData ('is_home', $this->is_dashboard);
        helper ($this->helpers);
        if (!$this->__is_public_cookies_set ()) $this->locale = $this->appConfig->defaultLocale;    
        else {
            $urlLocale      = explode ('/', $this->request->getPath ());
            $localeCookie   = unserialize (get_cookie (__SYS_PUBLIC_COOKIEKEY__));
            if ($urlLocale[0] === '' || ($urlLocale[0] === $localeCookie['locale'])) $this->locale   = $localeCookie['locale'];
            else {
                $this->__set_public_cookie_data('locale', $urlLocale[0]);
                $this->locale   = $urlLocale[0];
            }
        }
        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
    
    abstract public function index (): string;
}
