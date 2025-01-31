<?php
namespace App\Controllers;


use App\Libraries\CURLRequestMapper;

class Pooling extends BaseController {
    
    private $columnMapper   = array ();
    
    public function index (): string {
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
            $retVal = array ();
            if (!$draw) $retVal = $this->loadPageContents ($post, $mapper);    
            else $retVal = $this->loadDataTableContents ($draw, $post, $mapper);
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
    private function loadDataTableContents (int $draw, array $post, CURLRequestMapper $mapper): array {
        $fetch      = $post['fetch'];
        $modelName  = $mapper->getTargetModelName ($fetch);
        $model      = new $modelName ($this->__readLicFile(), $this->request);
        $payload    = array ();
        $status     = $model->getData ($payload, $post, $this->getUserUUID (), TRUE);
        if ($status === 200) $data = $payload;
        else $data = array ();
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
    private function loadPageContents (array $post, CURLRequestMapper $mapper): array {
        $toLoad = explode ("|", $post['fetch']);
        $retVal = array (
            'length'    => 0,
            'data'      => array ()
        );
        foreach ($toLoad as $fetch) {
            if (!array_key_exists ($fetch, $retVal['data'])) $retVal['data'][$fetch] = array ();
            $modelName  = $mapper->getTargetModelName ($fetch);
            $model      = new $modelName ($this->__readLicFile(), $this->request);
            $payloads   = array ();
            $status     = $model->getData ($payloads, $post, $this->getUserUUID ());
            if ($status === 200) {
                $result     = array ();
                foreach ($payloads as $payload) {
                    foreach ($payload as $k => $v) 
                        if (!$mapper->isIgnoredKeys ($k)) $result[$k] = ($k === 'uuid') ? base64_encode ($v) : $v;
                    array_push ($retVal["data"][$fetch], $result);
                }
            }
        }
        $retVal['length'] = count ($retVal['data'][$fetch]);
        return $retVal;
    }
    
}