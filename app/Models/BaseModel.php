<?php
namespace App\Models;


use CodeIgniter\HTTP\IncomingRequest;
use Config\Server;
use CodeIgniter\I18n\Time;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\CLIRequest;

abstract class BaseModel {
    
    protected $api;
    protected $columns;
    protected $rulesets;
    protected $curl;
    protected $curlOpts;
    protected $modal;
    protected $fadeTarget='';
    protected $paramMap;
    protected $locale;
    
    /**
     * 
     * @var IncomingRequest $request
     */
    protected $request;
    
    private $serverURL;
    private $userKeyName;
    
    /**
     * 
     * @param string $relativePath
     * @return string
     */
    protected function getServerURL ($relativePath="") {
        return "{$this->serverURL}{$relativePath}";
    }
    
    protected function getUserKeyname ($userdata="") {
        return "{$this->userKeyName}={$userdata}";
    }
    
    /**
     *
     * @param number $num
     * @param string $data
     * @return string
     */
    protected function generateFirstColumn ($num=1, $data="") {
        return "<span data-row=\"{$data}\" class=\"d-hidden\" data-loadsource=\"key\">{$data}</span>{$num}";
    }
    
    /**
     * 
     * @param string $parts
     * @param array $pageData
     * @return string
     */
    protected function internalPartRenderer (string $parts, array $pageData) {
        $parser     = \Config\Services::parser ();
        $parser->setData ($pageData);
        return $parser->render ($parts);
    }
    
    protected function generateCreatedColumn (string $uuid, Time $param, bool $showDetail=TRUE, bool $showDelete=TRUE) {
        $pageData   = array (
            'uuid'          => base64_encode($uuid),
            'time_created'  => $param->toDateTimeString (),
            'tc_humanized'  => $param->humanize (),
            'more'          => lang ("Dashboard.texts.common.more", [], $this->locale),
            'btn_update'    => lang ("Dashboard.texts.common.update", [], $this->locale),
            'btn_details'   => lang ("Dashboard.texts.common.details", [], $this->locale),
            'btn_delete'    => lang ("Dashboard.texts.common.delete", [], $this->locale),
            'showDetail'    => $showDetail,
            'showDelete'    => $showDelete,
            'modal_target'  => $this->modal
        );
        return $this->internalPartRenderer ("dashboard/parts/created_at", $pageData);
    }
    
    protected function generateCreatedColumnOpenForm (string $uuid, Time $param, bool $showDetail=TRUE, bool $showDelete=TRUE) {
        $pageData   = array (
            'uuid'          => base64_encode ($uuid),
            'time_created'  => $param->toDateTimeString (),
            'tc_humanized'  => $param->humanize (),
            'more'          => lang ("Dashboard.texts.common.more", [], $this->locale),
            'btn_update'    => lang ("Dashboard.texts.common.update", [], $this->locale),
            'btn_details'   => lang ("Dashboard.texts.common.details", [], $this->locale),
            'btn_delete'    => lang ("Dashboard.texts.common.delete", [], $this->locale),
            'showDetail'    => $showDetail,
            'showDelete'    => $showDelete,
            'modal_target'  => $this->modal,
            'fade_target'   => $this->fadeTarget
        );
        return $this->internalPartRenderer ("dashboard/parts/created_at_form", $pageData);
    }
    
    protected function getRequestLocale () {
        return $this->locale;
    }
    
    protected function convertDate ($format, $originDate) {
        $timestamp  = strtotime ($originDate);
        if ($timestamp) {
            $newTimeFormat  = new Time ($originDate);
            return $newTimeFormat->toLocalizedString ($format);
        }
        return FALSE;
    }
    
    public function __construct (string $licData, IncomingRequest $request, $keyName="atom") {
        /**
         * 
         * @var Server $serverConfig
         */
        $serverConfig       = config ("Server");
        $this->request      = $request;
        $this->locale       = $request->getLocale ();
        $this->serverURL    = "{$serverConfig->server_url}{$serverConfig->infix_url}{$serverConfig->postfix_url}";
        $this->userKeyName  = $keyName;
        $this->curl         = \Config\Services::curlrequest ();
        $this->curlOpts     = array (
            'auth'              => array (
                $licData,
                '',
                'basic'
            ),
            'headers'           => array (
                'Content-Type'      => 'application/json',
                'Accept'            => 'application/json',
                'User-Agent'        => $request->getUserAgent ()
            ),
        );
    }
    
    public function getRuleSets ($type): array {
        if (!array_key_exists ($type, $this->rulesets)) return FALSE;
        return $this->rulesets[$type];
    }
    
    /**
     * 
     * @param array $payload
     * @param array $param
     * @param string $userData
     * @param bool $toDataTable
     * @return int
     */
    public function getData (array &$payload, array $param, string $userData="", bool $toDataTable=FALSE): int {
        $url    = "";
        if (!count ($param)) $url = $this->getServerURL ("{$this->api}?{$this->getUserKeyname ($userData)}");
        else {
            $searchVal  = array_key_exists ("search", $param) ? $param["search"]["value"] : "";
            if ($searchVal === "") $url = $this->getServerURL ("{$this->api}?{$this->getUserKeyname($userData)}");
            else {
                $sortTarget = 0;
                $sort       = "";
                if (array_key_exists ("order", $param)) {
                    $column     = $param["order"][0]["column"];
                    if ($column !== 0) {
                        $sortTarget = $this->columns[$column-1];
                        $sort       = $param["order"][0]["dir"];
                    }
                }
                $get        = "find%23{$searchVal}&colsort={$sortTarget}&typesort={$sort}";
                $url        = $this->getServerURL ("{$this->api}?payload={$get}&{$this->getUserKeyname($userData)}");
            }
        }
        
        if (array_key_exists ("subdata", $param)) $url .= "&joint={$param["subdata"]}";
        if (array_key_exists('filterType', $param)) $url .= "&ref={$param['filterType']}&refdata={$param['subfilter']}";
        
        $serverResponse = json_decode ($this->curl->request ("get", $url, $this->curlOpts)->getBody (), TRUE);
        if ($serverResponse['status'] === 200 && array_key_exists ('data', $serverResponse)) {
            $payload        = unserialize (base64_decode ($serverResponse['data']['payload']));
            if ($toDataTable) $payload = $this->asDataTableFormat ($payload);
        }
        return $serverResponse['status'];
    }
    
    public function createData (array $data, array &$response, string $userData=""): int {
        if (! count ($data)) return 500;
        else {
            $this->curlOpts['json'] = $data;
            $url            = $this->getServerURL ("{$this->api}?{$this->getUserKeyname($userData)}");
            $srvResponse    = json_decode ($this->curl->request ("post", $url, $this->curlOpts)->getBody (), TRUE);
            $status         = $srvResponse['status'];
            if ($status === 200 && array_key_exists ("data", $srvResponse))
                $response       = unserialize (base64_decode ($srvResponse['data']['payload']));
            return $status;
        }
    }
    
    public function updateData (array $data, array &$response, string $param, string $userData=""): int {
        if (! count ($data)) return 500;
        else {
            $this->curlOpts['json'] = $data;
            $url            = $this->getServerURL ("{$this->api}/{$param}?{$this->getUserKeyname($userData)}");
            $srvResponse    = json_decode ($this->curl->request ("put", $url, $this->curlOpts)->getBody (), TRUE);
            $status         = $srvResponse['status'];
            if ($status === 200 && array_key_exists ("data", $srvResponse)) 
                $response       = unserialize (base64_decode ($srvResponse['data']['payload']));
            return $status;
        }
    }
    
    public function removeData (array $data, array &$response, string $param, string $userData=""): int {        
    }
    
    /**
     * 
     * @return array
     */
    public function createParams () {
        $post   = $this->request->getPost ();
        $params = array ();
        foreach ($this->paramMap as $key => $value) 
            $params[$value] = (array_key_exists ($key, $post) ?  ($post[$key] === 'true' ? TRUE : $post[$key]) : FALSE);
        return $params;
    }
    
    abstract protected function asDataTableFormat (array $params): array;
}