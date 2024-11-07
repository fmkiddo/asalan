<?php
namespace App\Controllers;


use App\Libraries\CURLRequestMapper;

class Pooling extends BaseController {
    
    public function index(): string {
        $this->__initSession ();
        if (!($this->__isSessionSet () && $this->request->is ('post'))) {
            $retVal = array (
                'status'    => 404,
                'error'     => 404,
                'messages'  => array (
                    'error'     => ''
                )
            );
        } else {
            $post       = $this->request->getPost ();
            $mapper     = new CURLRequestMapper ();
            $draw       = (array_key_exists ('draw', $post)) ? $post['draw'] : 0;
            $fetch      = $post['fetch'];
            $api        = $mapper->getTargetAPI ($fetch);
            $searchVal  = (array_key_exists ('search', $post) ? $post['search']['value'] : '');
            $sortTarget = 0;
            $sort       = '';
            if (array_key_exists ('order', $post)) {
                
            }
            
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
            
            $data       = array ();
            $get        = "find%23{$searchVal}&colsort={$sortTarget}&typesort={$sort}";
            $response   = $this->sendRequest (
                            $this->__getServerURL ("{$api}?payload={$get}&atom={$this->getUserUUID ()}"), 
                            $curlOpts);
            $json       = json_decode ($response->getBody (), TRUE);
            if ($json['status'] === 200 && array_key_exists ('data', $json)) {
                $responsePayload    = unserialize (base64_decode ($json['data']['payload']));
                $mapper->dataTableFormatter ($responsePayload, $data, $fetch);
            }
            
            $retVal = array (
                'draw'              => $draw,
                'recordsTotal'      => count ($data),
                'recordsFiltered'   => count ($data),
                'data'              => $data
            );
        }
        $this->response->setHeader ('Content-Type', 'application/json');
        $this->response->setBody (json_encode($retVal));
        $this->response->send ();
        return '';
    }
    
}