<?php
namespace App\Controllers;


use App\Libraries\CURLRequestMapper;

class Pooling extends BaseController {
    
    private $columnMapper   = array ();
    
    public function index(): string {
        $this->__initSession ();
        if (!($this->__isSessionSet () && $this->request->is ('post'))) {
            $retVal = array (
                'status'    => 404,
                'error'     => 404,
                'messages'  => array (
                    'error'     => lang ('Dashboard.Errors.404')
                )
            );
        } else {
            $post       = $this->request->getPost ();
            $mapper     = new CURLRequestMapper ();
            $draw       = (array_key_exists ('draw', $post)) ? $post['draw'] : 0;
            
            $curlOpts   = array (
                'auth'      => array (
                    $this->__readLicFile (),
                    '',
                    'basic'
                ),
                'headers'   => array (
                    'Content-Type'  => 'application/json',
                    'Accept'        => 'application/json',
                    'User-Agent'    => $this->request->getUserAgent ()
                )
            );
            
            $retVal = array ();
            if (!$draw) $retVal = $this->loadPageContents ($post, $mapper, $curlOpts);    
            else $retVal = $this->loadDataTableContents ($draw, $post, $mapper, $curlOpts);
        }
        $this->response->setHeader ('Content-Type', 'application/json');
        $this->response->setBody (json_encode ($retVal));
        $this->response->send ();
        return '';
    }
    
    /**
     * 
     * @param int $draw
     * @param array $post
     * @param CURLRequestMapper $mapper
     * @param array $curlOpts
     * @return array
     */
    private function loadDataTableContents (int $draw, array $post, CURLRequestMapper $mapper, array $curlOpts): array {
        $fetch      = $post['fetch'];
        $api        = $mapper->getTargetAPI ($fetch);
        $searchVal  = (array_key_exists ('search', $post) ? $post['search']['value'] : '');
        $sortTarget = 0;
        $sort       = "";
        $get        = "find%23{$searchVal}&colsort={$sortTarget}&typesort={$sort}";
        if (array_key_exists ('order', $post)) {
            
        }
        
        $data       = array ();
        $url        = $this->__getServerURL ("{$api}?payload={$get}&atom={$this->getUserUUID ()}");
        $response   = $this->sendRequest ($url, $curlOpts);
        $json       = json_decode ($response->getBody (), TRUE);
        if ($json['status'] === 200 && array_key_exists ('data', $json)) {
            $responsePayload    = unserialize (base64_decode ($json['data']['payload']));
            $mapper->dataTableFormatter ($responsePayload, $data, $fetch);
        }
            
        return array (
            'draw'              => $draw,
            'recordsTotal'      => count ($data),
            'recordsFiltered'   => count ($data),
            'data'              => $data
        );
    }
    
    /**
     * 
     * @param array $post
     * @param CURLRequestMapper $mapper
     * @param array $curlOpts
     * @return array
     */
    private function loadPageContents (array $post, CURLRequestMapper $mapper, array $curlOpts): array {
        $toLoad = explode ("|", $post['fetch']);
        $retVal = array (
            'length'    => 0,
            'data'      => array ()
        );
        foreach ($toLoad as $fetch) {
            if (!array_key_exists($fetch, $retVal['data'])) $retVal['data'][$fetch] = array ();
            $api        = $mapper->getTargetAPI ($fetch);
            $url        = $this->__getServerURL("{$api}");
            $response   = json_decode ($this->sendRequest ($url, $curlOpts)->getBody (), TRUE);
            if ($response['status'] === 200) {
                $payloads   = $response['data']['payload'];
                $payloads   = unserialize (base64_decode ($payloads));
                $result     = array ();
                foreach ($payloads as $payload) {
                    foreach ($payload as $k => $v) 
                        if (!$mapper->isIgnoredKeys($k)) $result[$k] = ($k === 'uuid') ? base64_encode ($v) : $v;
                    array_push ($retVal['data'][$fetch], $result);
                }
            }
        }
        $retVal['length'] = count ($retVal['data']);
        return $retVal;
    }
    
    private function columnSortMapper () {
        
    }
    
}