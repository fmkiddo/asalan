<?php
namespace App\Models;


class ConfigItem extends BaseModel {
    
    protected $api      = "config-items";
    protected $modal    = "modalCIForm";
    protected $paramMap = array (
        'input-ciname'          => 'newci-name',
        'input-cidscript'       => 'newci-dscript',
        'input-cideprem'        => 'newci-depremthd',
        'input-cisalvagev'      => 'newci-salvagev',
        'input-cidtype'         => 'newci-attrs',
    );
    protected $columns  = array (
        'ci_name', 'ci_dscript', 'depreciation_method', 'salvage_value'
    );
    protected $rulesets = array (
        'new'   => array (
            'input-ciname'      => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-cidscript'   => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-cideprem'   => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-cisalvagev'   => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-cidtype'     => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                )
            ),
        ),
        'edit'  => array (
            'input-ciname'      => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-cidscript'   => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-cideprem'   => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-cisalvagev'   => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-cidtype'     => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                )
            ),
        )
    );
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::createData()
     */
    public function createData(array $data, array &$response, string $userData = ""): int {
        if (! count ($data)) return 500;
        $ciResponse = array ();
        $status = parent::createData ($data, $ciResponse, $userData);
        if ($status === 200) {
            $json           = array (
                'newci-uuid'    => $ciResponse['uuid'],
                'newci-attrs'   => $data['newci-attrs'],
            );
            $api            = 'ci-attributes';
            $url            = $this->getServerURL ("{$api}?{$this->getUserKeyname ($userData)}"); 
            $this->curlOpts['json'] = $json;
            $ciAttrResponse = json_decode ($this->curl->request ('post', $url, $this->curlOpts)->getBody (), TRUE);
            if ($ciAttrResponse['status'] === 200) {
                $ciaPayloads    = unserialize (base64_decode ($ciAttrResponse['data']['payload']));
                $response       = array (
                    $ciResponse,
                    $ciaPayloads
                );
            }
        }
        return $status;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\Models\BaseModel::asDataTableFormat()
     */
    
    public function asDataTableFormat(array $params): array {
        $output = array ();
        $i = 1;
        foreach ($params as $k => $row) {
            $output[$k]  = array (
                $this->generateFirstColumn ($i, base64_encode($row['uuid'])),
                "<span data-loadsource=\"code\">{$row['name']}</span>",
                "<span data-loadsource=\"dscript\">{$row['dscript']}</span>",
                "<span class=\"d-hidden\" data-loadsource=\"depre-method\">{$row['depre_method']}</span>" . lang("Dashboard.texts.ci.modal.depreopt{$row['depre_method']}"),
                "<span data-loadsource=\"salvage-value\">{$row['salvage_value']}</span>%",
                $this->generateCreatedColumn($row['uuid'], $row['created_at'], FALSE, FALSE),
            );
            $i++;
        }
        return $output;
    }

    
}