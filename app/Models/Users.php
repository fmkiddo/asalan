<?php
namespace App\Models;


class Users extends BaseModel {
    
    protected $api      = "users";
    protected $modal    = "modalFormUser";
    protected $paramMap = array (
        'input-grouptype'       => 'newuser-groupid',
        'input-uname'           => 'newuser-name',
        'input-email'           => 'newuser-email',
        'input-pswd'            => 'newuser-password',
        'input-useractive'      => 'newuser-active',
    );
    protected $columns  = array (
        "username", "ougr.name", "email", "active", "created_at"
    );
    protected $rulesets = array (
        'new'           => array (
            'input-uname'   => array (
                'rules'         => 'required',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
            'input-email'   => array (
                'rules'         => 'required|valid_email',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
            'input-cemail'  => array (
                'rules'         => 'required|matches[input-email]|valid_email',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
            'input-pswd'    => array (
                'rules'         => 'required|strong_password|min_length[8]',
                'errors'        => array (
                    'required'          => '',
                    'strong_password'   => '',
                    'min_length'        => ''
                ),
            ),
            'input-cpswd'   => array (
                'rules'         => 'required|matches[input-pswd]',
                'errors'        => array (
                    'required'      => '',
                    'matches'       => '',
                ),
            ),
        ),
        'edit'          => array (
            'input-uname'   => array (
                'rules'         => 'required',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
            'input-email'   => array (
                'rules'         => 'required|valid_email',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
            'input-cemail'  => array (
                'rules'         => 'required|matches[input-email]|valid_email',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
        ),
    );
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\Models\BaseModel::asDataTableFormat()
     */
    protected function asDataTableFormat(array $params): array {
        $output = array ();
        $i = 1;
        foreach ($params as $k => $row) {
            $base64_groupID = base64_encode ($row['group_id']);
            $activeUser     = $row['active'] ? 'true' : 'false';
            $content        = ($row['active'] ? "<i class=\"mdi mdi-check-circle text-success\"></i>" : "<i class=\"mdi mdi-close-circle text-danger\"></i>");
            $output[$k]  = array (
                $this->generateFirstColumn ($i, base64_encode($row['uuid'])),
                "<span class=\"d-hidden\">{$row['locations']}</span><span data-loadsource=\"username\">{$row['username']}</span>",
                "<span data-loadsource=\"usergroup\" class=\"d-hidden\">{$base64_groupID}</span><span data-loadsource=\"usergroupname\">{$row['group_name']}</span",
                "<span data-loadsource=\"useremail\">{$row['email']}</span>",
                "<span data-loadsource=\"active\" class=\"d-hidden\">{$activeUser}</span>{$content}",
                $this->generateCreatedColumn ($row['uuid'], $row['created_at'], TRUE, FALSE),
            );
            $i++;
        }
        return $output;
    }
}