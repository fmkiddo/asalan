<?php
namespace App\Models;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\I18n\Time;

class Procurement extends BaseModel {
    
        
    private $isExists;
    protected $api      = "fa-procure";
    protected $modal    = "modalProcureExist";
    protected $paramMap = array (
        'faprocurex'        => array (
            'input-faplocopt'       => 'newfap-locationid',
            'input-fapdocdate'      => 'newfap-date',
            'input-fapapplicant'    => 'newfap-applicant',
            'input-fapdatarow'      => 'newfap-assetdata',
            'input-fapvalue'        => 'newfap-assetvalue',
            'input-fapqty'          => 'newfap-assetqty',
            'input-fapremark'       => 'newfap-remarks',
        ),
        'faprocuren'        => array (
            'input-faplocopt'       => 'newfap-locationid',
            'input-fapdocdate'      => 'newfap-date',
            'input-fapapplicant'    => 'newfap-applicant',
            'input-fapname'         => 'newfap-assetname',
            'input-fapdscript'      => 'newfap-assetdscript',
            'input-fapvalue'        => 'newfap-assetvalue',
            'input-fapqty'          => 'newfap-assetqty',
            'input-fapremark'       => 'newfap-remarks',
        ),
    );
    protected $columns  = array (
        
    );
    protected $rulesets = array (
        'faprocurex'    => array (
            'new'           => array (
                'input-faplocopt'       => array (
                    'rules'                 => 'required',
                    'errors'                => array (
                        'required'              => '',
                    ),
                ),
                'input-fapdocdate'      => array (
                    'rules'                 => 'required',
                    'errors'                => array (
                        'required'              => '',
                    ),
                ),
                'input-fapapplicant'    => array (
                    'rules'                 => 'required',
                    'errors'                => array (
                        'required'              => '',
                    ),
                ),
                'input-fapdatarow.*'    => array (
                    'rules'                 => 'required',
                    'errors'                => array (
                        'required'              => '',
                    ),
                ),
                'input-fapvalue.*'      => array (
                    'rules'                 => 'required|numeric',
                    'errors'                => array (
                        'required'              => '',
                        'numeric'               => '',
                    ),
                ),
                'input-fapqty.*'        => array (
                    'rules'                 => 'required|numeric',
                    'errors'                => array (
                        'required'              => '',
                        'numeric'               => '',
                    ),
                ),
                'input-fapremark.*'     => array (
                    'rules'                 => 'required',
                    'errors'                => array (
                        'required'              => '',
                    ),
                ),
            ),
            'edit'          => array (),
        ),
        'faprocuren'    => array (
            'new'           => array (
                'input-faplocopt'       => array (
                    'rules'                 => 'required',
                    'errors'                => array (
                        'required'              => '',
                    ),
                ),
                'input-fapdocdate'      => array (
                    'rules'                 => 'required',
                    'errors'                => array (
                        'required'              => '',
                    ),
                ),
                'input-fapapplicant'    => array (
                    'rules'                 => 'required',
                    'errors'                => array (
                        'required'              => '',
                    ),
                ),
                'input-fapname.*'       => array (
                    'rules'                 => 'required',
                    'errors'                => array (
                        'required'              => '',
                    ),
                ),
                'input-fapdscript.*'    => array (
                    'rules'                 => 'required',
                    'errors'                => array (
                        'required'              => '',
                    ),
                ),
                'input-fapvalue.*'      => array (
                    'rules'                 => 'required|numeric',
                    'errors'                => array (
                        'required'              => '',
                        'numeric'               => '',
                    ),
                ),
                'input-fapqty.*'        => array (
                    'rules'                 => 'required|numeric',
                    'errors'                => array (
                        'required'              => '',
                        'numeric'               => '',
                    ),
                ),
                'input-fapremark.*'     => array (
                    'rules'                 => 'required',
                    'errors'                => array (
                        'required'              => '',
                    ),
                ),
            ),
            'edit'          => array (),
        ),
    );
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::__construct()
     */
    public function __construct (string $licData, IncomingRequest $request, $keyName = "atom") {
        parent::__construct ($licData, $request, $keyName);
        $post       = $request->getPost ();
        if (array_key_exists ('request-type', $post)) {
            $reqType    = explode ('|', $post['request-type']);
            if ('faprocuren' === $reqType[0]) $this->isExists = FALSE;
            else $this->isExists = TRUE;
        }
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::createData()
     */
    public function createData (array $data, array &$response, string $userData = ""): int {
        $result = parent::createData($data, $response, $userData);
        if ($result === 200 && (!$this->isExists)) {
            // upload image here
        }
        return $result;
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::getRuleSets()
     */
    public function getRuleSets ($type): array {
        if (!$this->isExists) return $this->rulesets['faprocuren'][$type];
        return $this->rulesets['faprocurex'][$type];
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::createParams()
     */
    public function createParams () {
        $paramMap   = (!$this->isExists) ? $this->paramMap['faprocuren'] : $this->paramMap['faprocurex'];
        $post   = $this->request->getPost ();
        $params = array ();
        
        $params['newfap-proctype']    = (!$this->isExists) ? 2 : 1;
        foreach ($paramMap as $key => $value)
            $params[$value] = (array_key_exists ($key, $post) ?  ($post[$key] === 'true' ? TRUE : $post[$key]) : FALSE);
        
        if (!$this->isExists) {
            $files  = $this->request->getFiles ();
            if (count ($files['input-fapimage'])) {
                $params['newfap-images']    = array ();
                foreach ($files['input-fapimage'] as $k => $procureImages) {
                    $params['newfap-images'][$k]    = array ();
                    foreach ($procureImages as $image) {
                        $filename   = $image->getRandomName ();
                        array_push ($params['newfap-images'][$k], $filename);
                    }
                }
            }
        }
        
        return $params;
    }
    
    
    protected function asDataTableFormat (array $params): array {
        helper ('document_status');
        $output = array ();
        $dateFormat = ($this->locale === 'id' ? 'dd MMMM yyyy' : 'MMMM dd, yyyy');
        foreach ($params as $k => $data) {
            $docid      = base64_encode ($data['uuid']);
            $docdate    = new Time ($data['docdate']);
            $applicant  = $data['applicant'];
            $location   = $data['location'];
            $name       = (($applicant['name']['firstname'] == NULL || $applicant['name']['firstname'] === '') ? $applicant['username'] :
                (($applicant['name']['middlename'] == NULL || $applicant['name']['middlename'] === '') ?
                    "{$applicant['name']['firstname']} {$applicant['name']['lastname']}" :
                    "{$applicant['name']['firstname']} {$applicant['name']['middlename']} {$applicant['name']['lastname']}"));
            $name       = "<span title=\"{$applicant['username']}\">{$name}</span>";
            $output[$k] = array (
                $this->generateFirstColumn (($k+1), $docid),
                "<a class=\"d-hidden\" data-action=\"open-dialog\" data-action-target=\"#modalDetail\"></a><span data-loadsource=\"docnum\">{$data['docnum']}</span>",
                "<span data-loadsource=\"docdate\">{$docdate->toLocalizedString ($dateFormat)}</span>",
                "<span data-loadsource=\"applicant_name\">{$name}</span>",
                "<span data-loadsource=\"location\">{$location['name']}</span>",
                mutating_document_status ($data['status'], $this->locale),
            );
        }
        return $output;
    }
}