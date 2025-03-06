<?php
namespace App\Models;

use CodeIgniter\I18n\Time;

class TransferOut extends BaseModel {
    
    protected $api      = "fa-tsout";
    protected $modal    = "modalDetail";
    protected $paramMap = array (
        'input-fatapplicant'    => 'newfat-applicant',
        'input-fatlocori'       => 'newfat-origin',
        'input-fatlocdest'      => 'newfat-destination',
        'input-fatremark'       => 'newfat-remarks',
        'input-famdatarow'      => 'newfat-assetdata',
        'input-famqty'          => 'newfat-assetqty',
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
            'input-famdatarow.*'   => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-famqty.*'      => array (
                'rules'             => 'required|numeric',
                'errors'            => array (
                    'required'          => '',
                    'numeric'           => '',
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
                'newfat-uuid'   => $docUID,
                'newfat-origin' => $data['newfat-origin'],
                'newfat-items'  => array (),
            );
            
            foreach ($data['newfat-assetdata'] as $k => $v) 
                $json['fat-items'][$k]  = array (
                    'newfat-uuid'   => $v,
                    'newfat-qty'    => $data['newfat-assetqty'][$k],
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
            $docid      = base64_encode ($data['uuid']);
            $docdate    = new Time ($data['docdate']);
            $applicant  = $data['applicant'];
            $appName    = ($applicant['name']['firstname'] == NULL || $applicant['name']['firstname'] === '') ? 
                $applicant['username'] : ($applicant['name']['middlename'] == NULL || $applicant['name']['middlename'] === '' ?
                    "{$applicant['name']['firstname']} {$applicant['name']['lastname']}" : 
                    "{$applicant['name']['firstname']} {$applicant['name']['middlename']} {$applicant['name']['lastname']}");
            $approval   = $data['approval'];
            $approvalAt = $approval['at'];
            if ($approvalAt == NULL) $approveDate   = '-';
            else {
                $appAtDate      = new Time ($approvalAt);
                $approveDate    = $appAtDate->toLocalizedString ($dateFormat);
            }
            $approvalBy = $approval['by'];
            if ($approvalBy['id'] == NULL) $approvName = '-';
            else 
                $approvName = ($approvalBy['name']['firstname'] == NULL || $approvalBy['name']['firstname'] === '') ?
                    $approvalBy['username'] : ($approvalBy['name']['middlename'] == NULL || $approvalBy['name']['middlename'] === '' ?
                        "{$approvalBy['name']['firstname']} {$approvalBy['name']['lastname']}" :
                        "{$approvalBy['name']['firstname']} {$approvalBy['name']['middlename']} {$approvalBy['name']['lastname']}");
                    
            $output[$k] = array (
                $this->generateFirstColumn (($k+1), $docid),
                "<a class=\"d-hidden\" data-action=\"open-dialog\" data-action-target=\"#modalDetail\"></a><span data-loadsource=\"docnum\">{$data['docnum']}</span>",
                "<span data-loadsource=\"docdate\">{$docdate->toLocalizedString ($dateFormat)}</span>",
                "<span data-loadsource=\"applicant_name\">{$appName}</span>",
                mutating_document_status ($data['status'], $this->locale),
                "<span data-loadsource=\"approved_by\">{$approvName}</span>",
                "<span data-loadsource=\"approved_at\">{$approveDate}</span>",
            );
        }
        return $output;
    }
}