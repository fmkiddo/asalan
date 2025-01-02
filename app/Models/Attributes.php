<?php
namespace App\Models;


class Attributes extends BaseModel { 
    
    protected $api      = "config-attributes";
    protected $modal    = "modalCompForm";
    protected $paramMap = array (
        'input-propname'        => 'newattr-name',
        'input-proptype'        => 'newattr-type',
        'input-plist'           => 'newattr-plistval'
    );
    protected $columns  = array (
        "attr_name", "attr_type"
    );
    protected $rulesets = array (
        'new'   => array (
            'input-propname'    => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-proptype'    => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
        ),
        'edit'  => array (
            'input-propname'    => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-proptype'    => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
        )
    );
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::createData()
     */
    public function createData(array $data, array &$response, string $userData = ""): int {
        if (! count ($data)) return 500;
        $dtype  = $data['newattr-type'];
        if ($dtype === "plist") $data['newattr-type'] = "prepopulated-list";
        $attrResponse   = array ();
        $status         = parent::createData ($data, $attrResponse, $userData);
        if ($dtype === "plist" && $status === 200) {
            $json       = array (
                'newattr-uuid'  => $attrResponse['uuid'],
                'newattr-value' => $data['newattr-plistval']
            );
            $api    = "attr-pre-list";
            $url    = $this->getServerURL ("{$api}?{$this->getUserKeyname($userData)}");
            $this->curlOpts['json'] = $json;
            $plistResponse  = json_decode ($this->curl->request ('post', $url, $this->curlOpts)->getBody (), TRUE);
            if ($plistResponse['status'] === 200 && array_key_exists('data', $plistResponse)) $response   = $attrResponse;
        } else {
            $status     = 500;
            $response   = array ();
        }
            
        return $status;
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::getData()
     */
    public function getData(array &$payload, array $param, string $userData = "", bool $toDataTable = FALSE): int {
        $tpayload = array ();
        $status = parent::getData ($tpayload, $param, $userData, $toDataTable);
        $i = 0;
        foreach ($tpayload as $data) {
            $type           = $data['type'];
            $data['type']   = lang("Dashboard.texts.ci.datatype.{$type}");
            $payload[$i]    = $data;
            $i++;
        }
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