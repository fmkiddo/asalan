<?php
namespace App\Libraries;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\I18n\Time;

class CURLRequestMapper {
    
    private $mapping    = array (
        'profile'   => array (
            'input-fname'           => 'user-fname',
            'input-mname'           => 'user-mname',
            'input-lname'           => 'user-lname',
            'input-addr1'           => 'user-addr1',
            'input-addr2'           => 'user-addr2',
            'input-phone'           => 'user-phone',
            'input-email'           => 'user-email',
        ),
        'acl'       => array (
            'input-groupcode'       => 'controlcode',
            'input-groupdscript'    => 'controlname',
            'input-groupcaprv'      => 'control-canapprove',
            'input-groupcremv'      => 'control-canremove',
            'input-groupcsend'      => 'control-cansend',
        ),
        'users'     => array (
            'input-grouptype'       => 'newuser-groupid',
            'input-uname'           => 'newuser-name',
            'input-email'           => 'newuser-email',
            'input-pswd'            => 'newuser-password',
            'input-useractive'      => 'newuser-active',
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
        foreach ($mapper as $k => $v) 
            $params[$v] = (array_key_exists ($k, $post) ?  ($post[$k] === 'true' ? TRUE : $post[$k]) : FALSE);
        /**
        foreach ($post as $k => $v) 
            if (array_key_exists ($k, $mapper)) $params[$mapper[$k]] = $v;**/
        
        if ($router === 'profile') {
            /**
             * 
             * @var UploadedFile $file
             */
            $file   = $request->getFile ('input-urpic');
            $params['user-image'] = _from_random (32, __SYS_ALPHA_NUMERIC__) . ".{$file->getExtension()}";
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
        $i = 1;
        switch ($target) {
            default:
                break;
            case 'acl':
                foreach ($input as $k => $row) {
                    $tableData[$k]  = array (
                        $this->generateFirstColumn ($i, base64_encode($row['uuid'])),
                        $row['code'],
                        $row['name'],
                        ($row['can_approve'] ? "<i class=\"mdi mdi-check-circle text-success\"></i>" : "<i class=\"mdi mdi-close-circle text-danger\"></i>"),
                        ($row['can_remove'] ? "<i class=\"mdi mdi-check-circle text-success\"></i>" : "<i class=\"mdi mdi-close-circle text-danger\"></i>"),
                        ($row['can_send'] ? "<i class=\"mdi mdi-check-circle text-success\"></i>" : "<i class=\"mdi mdi-close-circle text-danger\"></i>"),
                        $this->generateCreatedColumn($row['uuid'], $row['created_at']),
                    );
                    $i++;
                }
                break;
            case 'users':
                foreach ($input as $k => $row) {
                    $base64_groupID = base64_encode ($row['group_id']);
                    $activeUser     = $row['active'] ? 'true' : 'false';
                    $content        = ($row['active'] ? "<i class=\"mdi mdi-check-circle text-success\"></i>" : "<i class=\"mdi mdi-close-circle text-danger\"></i>");
                    $tableData[$k]  = array (
                        $this->generateFirstColumn ($i, base64_encode($row['uuid'])),
                        "<span data-loadsource=\"username\">{$row['username']}</span>",
                        "<span data-loadsource=\"usergroup\" class=\"d-hidden\">{$base64_groupID}</span>{$row['group_name']}",
                        "<span data-loadsource=\"useremail\">{$row['email']}</span>",
                        "<span data-loadsource=\"active\" class=\"d-hidden\">{$activeUser}</span>{$content}",
                        $this->generateCreatedColumn($row['uuid'], $row['created_at']),
                    );
                    $i++;
                }
                break;
        }
    }
    
    /**
     * 
     * @param string $key
     * @return boolean
     */
    public function isIgnoredKeys (string $key) {
        $ignored = FALSE;
        if ($key === 'created_at' || $key === 'created_by' || $key === 'updated_at' || $key === 'updated_by') $ignored = TRUE;
        return $ignored;
    }
    
    /**
     * 
     * @param number $num
     * @param string $data
     * @return string
     */
    private function generateFirstColumn ($num=1, $data="") {
        return "<span data-row=\"{$data}\"></span>{$num}";
    }
    
    /**
     * 
     * @param string $uuid
     * @param Time $param
     * @return string
     */
    private function generateCreatedColumn (string $uuid, Time $param) {
        $parser     = \Config\Services::parser ();
        $pageData   = array (
            'uuid'          => base64_encode($uuid),
            'time_created'  => $param->toDateTimeString (),
            'tc_humanized'  => $param->humanize ()
        );
        $parser->setData ($pageData);
        return $parser->render ("dashboard/parts/created_at");        
    }
}