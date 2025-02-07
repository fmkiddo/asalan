<?php
namespace App\Models;


use CodeIgniter\I18n\Time;

class AssetTransferOut extends BaseModel {
    
    protected $api      = "fa-tsout";
    protected $modal    = "modalTsoutForm";
    protected $paramMap = array (
        'input-fatapplicant'    => 'fat-applicant',
        'input-fatlocori'       => 'fat-origin',
        'input-fatlocdest'      => 'fat-destination',
        'input-fatremark'       => 'fat-remarks',
        'input-assetuuid'       => 'fat-assetuuid',
        'input-assetqty'        => 'fat-assetqty',
    );
    protected $columns  = array (
    );
    protected $rulesets = array (
        'new'   => array (
            'input-fatlocori'   => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-fatlocdest'  => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-assetuuid'   => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-assetqty'    => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
        ),
        'edit'  => array (),
    );
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::createData()
     */
    public function createData(array $data, array &$response, string $userData = ""): int {
        $transferResponse   = array ();
        $status = parent::createData($data, $transferResponse, $userData);
        if ($status === 200) {
            $api    = 'fa-tsout-item';
            $docUID = $transferResponse['uuid'];
            $json   = array (
                'fat-uuid'      => $docUID,
                'fat-origin'    => $data['fat-origin'],
                'fat-items'     => array (),
            );
            
            foreach ($data['fat-assetuuid'] as $k => $v) 
                $json['fat-items'][$k]  = array (
                    'fat-uuid'  => $v,
                    'fat-qty'   => $data['fat-assetqty'][$k],
                );
                
            $url    = $this->getServerURL ("{$api}?{$this->getUserKeyname ($userData)}");
            $this->curlOpts['json'] = $json;
            $itemsResponse  = json_decode ($this->curl->request ('post', $url, $this->curlOpts)->getBody (), TRUE);
            if ($itemsResponse['status'] === 200) {
                var_dump ($itemsResponse);
            }
        }
        return $status;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \App\Models\BaseModel::asDataTableFormat()
     */
    protected function asDataTableFormat(array $params): array {
        helper ('document_status');
        $output = array ();
        $dateFormat = ($this->locale === 'id' ? 'dd MMMM yyyy' : 'MMMM dd, yyyy');
        foreach ($params as $k => $data) {
            $i          = $k + 1;
            $docUUID    = base64_encode ($data['uuid']);
            $applicant  = $data['applicant'];
            $fname      = $applicant['fname'];
            $applString = $applicant['username'];
            if (!($fname === '' || $fname === NULL)) {
                $aText  = lang ('Dashboard.texts.common.user', [$applString], $this->locale);
                $applString = "<span title=\"{$aText}\">{$applicant['fname']} {$applicant['mname']} {$applicant['lname']}</span>";
            }
            
            $status     = mutating_document_status ($data['status'], $this->locale);
            
            $apprString = ' - ';
            $approval   = $data['approvedby'];
            if (!($approval['uuid'] === NULL)) {
                $apprFname  = $approval['fname'];
                $apprString = $approval['username'];
                if (!($apprFname === '' || $apprFname === NULL)) {
                    $aText  = lang ('Dashboard.texts.common.user', [$applString], $this->locale);
                    $apprString = "<span title=\"{$aText}\">{$approval['fname']} {$approval['mname']} {$approval['lname']}</span>";
                }
            }
            
            $apprDate   = ' - ';
            if (!($data['approvaldate'] === NULL)) $apprDate = $this->convertDate ($dateFormat, $data['approvaldate']);
            
            
            $output[$k] = array (
                $this->generateFirstColumn($i, $docUUID),
                "<span><a id=\"openModalDetails\" class=\"d-hidden\" data-bs-target=\"#modalDetail\" data-bs-toggle=\"modal\" data-target=\"{$docUUID}\"></a>{$data['docnum']}</span>",
                $this->convertDate ($dateFormat, $data['docdate']),
                $applString,
                $status,
                $apprString,
                $apprDate,
            );
        }
        return $output;
    }
}