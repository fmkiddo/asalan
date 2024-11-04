<?php
namespace App\Libraries;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\Files\UploadedFile;

class CURLRequestMapper {
    
    private $mapping    = array (
        'profile'   => array (
            'input-fname'   => 'user-fname',
            'input-mname'   => 'user-mname',
            'input-lname'   => 'user-lname',
            'input-addr1'   => 'user-addr1',
            'input-addr2'   => 'user-addr2',
            'input-phone'   => 'user-phone',
            'input-email'   => 'user-email',
        )
    );
    
    private $apiMapping = array (
        'profile'   => 'user-profile'
    );
    
    public function __construct () { }
    
    /**
     * 
     * @param string $router
     * @param RequestInterface|CLIRequest $request
     * @return array|boolean
     */
    public function getCURLparams (string $router, RequestInterface|CLIRequest $request) {
        if (!array_key_exists ($router, $this->mapping)) return FALSE;
        $post   = $request->getPost ();
        $mapper = $this->mapping[$router];
        $params = array ();
        foreach ($post as $k => $v) 
            if (array_key_exists ($k, $mapper)) $params[$mapper[$k]] = $v;
        
        if ($router === 'profile') {
            /**
             * 
             * @var UploadedFile $file
             */
            $file   = $request->getFile ('input-urpic');
            $params['user-image'] = _from_random (32, "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890") . ".{$file->getExtension()}";
        }
        return $params;
    }
    
    public function getTargetAPI (string $router) {
        if (!array_key_exists ($router, $this->apiMapping)) return FALSE;
        return $this->apiMapping[$router];
    }
}