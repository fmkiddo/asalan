<?php
namespace App\Models;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\Files\UploadedFile;

class Profile extends BaseModel {
    
    
    protected $api      = "user-profile";
    protected $modal    = "profileForm";
    protected $paramMap = array (
        'input-fname'           => 'user-fname',
        'input-mname'           => 'user-mname',
        'input-lname'           => 'user-lname',
        'input-addr1'           => 'user-addr1',
        'input-addr2'           => 'user-addr2',
        'input-phone'           => 'user-phone',
        'input-email'           => 'user-email',
    );
    protected $columns  = array ();
    protected $rulesets = array (
        'new'           => array (
            'input-fname'   => array (
                'rules'         => 'required',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
            'input-addr1'   => array (
                'rules'         => 'required',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
            'input-phone'   => array (
                'rules'         => 'required|numeric',
                'errors'        => array (
                    'required'      => '',
                    'numeric'       => '',
                ),
            ),
            'input-email'   => array (
                'rules'         => 'required|valid_email',
                'errors'        => array (
                    'required'      => '',
                    'valid_email'   => '',
                ),
            ),
        ),
        'edit'          => array (
            'input-fname'   => array (
                'rules'         => 'required',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
            'input-addr1'   => array (
                'rules'         => 'required',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
            'input-phone'   => array (
                'rules'         => 'required|numeric',
                'errors'        => array (
                    'required'      => '',
                    'numeric'       => '',
                ),
            ),
            'input-email'   => array (
                'rules'         => 'required|valid_email',
                'errors'        => array (
                    'required'      => '',
                    'valid_email'   => '',
                ),
            ),
        ),
    );
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::createParams()
     */
    public function createParams () {
        // TODO Auto-generated method stub
        $params = parent::createParams ();
        /**
         *
         * @var UploadedFile $file
         */
        $file   = $this->request->getFile ('input-urpic');
        $params['user-image'] = '';
        if ($file->getFilename() !== '') $params['user-image'] = _from_random (32, __SYS_ALPHA_NUMERIC__) . ".{$file->getExtension()}";
        return $params;
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::updateData()
     */
    public function updateData (array $data, array &$response, string $param, string $userData = ""): int {
        $status = $this->getData($response, array (), $userData);
        if ($status === 200 && count ($response) === 0) $status = $this->createData ($data, $response, $userData);
        else $status = parent::updateData ($data, $response, $param, $userData);
        return $status;
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::asDataTableFormat()
     */
    public function asDataTableFormat(array $params): array {
        return [];
    }
    
}