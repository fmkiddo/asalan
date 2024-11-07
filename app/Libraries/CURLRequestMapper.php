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
        'profile'   => 'user-profile',
        'acl'       => 'controller',
        'users'     => 'users'
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
    
    /**
     * 
     * @param array $input
     * @param array $tableData
     * @param string $target
     */
    public function dataTableFormatter (array $input, array &$tableData, string $target): void {
        switch ($target) {
            default:
                break;
            case 'acl':
                foreach ($input as $k => $row) {
                    $tableData[$k]  = array (
                        "<input type=\"checkbox\" data-single=\"true\" value=\"{$row['uuid']}\" />",
                        $row['code'],
                        $row['name'],
                        ($row['can_approve'] ? "<i class=\"mdi mdi-check-circle text-success\"></i>" : "<i class=\"mdi mdi-close-circle text-danger\"></i>"),
                        ($row['can_remove'] ? "<i class=\"mdi mdi-check-circle text-success\"></i>" : "<i class=\"mdi mdi-close-circle text-danger\"></i>"),
                        ($row['can_send'] ? "<i class=\"mdi mdi-check-circle text-success\"></i>" : "<i class=\"mdi mdi-close-circle text-danger\"></i>"),
                        $this->generateCreatedColumn($row['created_at'])
                    );
                }
                break;
            case 'users':
                foreach ($input as $k => $row) 
                    $tableData[$k]  = array (
                        "<input type=\"checkbox\" data-single=\"true\" value=\"{$row['uuid']}\" />",
                        $row['username'],
                        $row['group_name'],
                        $row['email'],
                        $this->generateCreatedColumn($row['created_at'])
                    );
                break;
        }
    }
    
    private function generateCreatedColumn ($param) {
        return "<span title=\"{$param->toDateTimeString ()}\">{$param->humanize ()}</span>";
    }
}