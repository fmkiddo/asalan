<?php
namespace App\Models;


class Assets extends BaseModel {
    
    protected $api      = "fixed-assets";
    protected $modal    = "modalAssetForm";
    protected $showType = 1;
    protected $paramMap = array (
        'input-optlocation'     => 'newfa-locationcode',
        'input-optsubloc'       => 'newfa-sublocationcode',
        'input-optfacategory'   => 'newfa-configitems',
        'input-newfacode'       => 'newfa-serialcode',
        'input-newfadscript'    => 'newfa-dscript',
        'input-newfaacqdate'    => 'newfa-acquireddate',
        'input-newfaacqcost'    => 'newfa-acquiredvalue',
        'input-newfalifespane'  => 'newfa-lifespan',
        'input-newfaqty'        => 'newfa-acquiredqty',
        'input-newfaremark'     => 'newfa-remarks',
        'input-newfaattrsid'    => 'newfa-attributesid',
        'input-newfaattrs'      => 'newfa-attributes',
    );
    protected $columns  = array (
        'code', 'name', 'oaci.dscript', 'qty'
    );
    protected $rulesets = array (
        'new'   => array (
            'input-optlocation' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-optsubloc' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-optfacategory' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-newfacode' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-newfadscript' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-newfaacqdate' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-newfaacqcost' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-newfaqty' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-newfalifespane'  => array (
                'rules'                 => 'required',
                'errors'                => array (
                    'required'              => ''
                ),
            ),
            'input-newfaattrs'      => array (
                'rules'                 => 'required',
                'errors'                => array (
                    'required'              => ''
                ),
            ),
        ),
        'edit'  => array (
            'input-optlocation' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-optsubloc' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-optfacategory' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-newfacode' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-newfadscript' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-newfaacqdate' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-newfaacqcost' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-newfaqty' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-newfalifespane' => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => ''
                ),
            ),
            'input-newfaattrs'      => array (
                'rules'                 => 'required',
                'errors'                => array (
                    'required'              => ''
                ),
            ),
        ),
    );
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::getData()
     */
    public function getData(array &$payload, array $param, string $userData = "", bool $toDataTable = FALSE): int {
        $url    = "";
        if (!count ($param)) $url = $this->getServerURL ("{$this->api}?{$this->getUserKeyname ($userData)}");
        else {
            $searchVal  = array_key_exists ("search", $param) ? $param["search"]["value"] : "";
            if ($searchVal === "") $url = $this->getServerURL ("{$this->api}?{$this->getUserKeyname($userData)}");
            else {
                $sortTarget = 0;
                $sort       = "";
                if (array_key_exists ("order", $param)) {
                    $column     = $param["order"][0]["column"];
                    if ($column !== 0) {
                        $sortTarget = $this->columns[$column-1];
                        $sort       = $param["order"][0]["dir"];
                    }
                }
                $get        = "find%23{$searchVal}&colsort={$sortTarget}&typesort={$sort}";
                $url        = $this->getServerURL ("{$this->api}?payload={$get}&{$this->getUserKeyname($userData)}");
            }
        }
        
        $url    .= "&showType={$this->showType}";
        if (array_key_exists ("subdata", $param)) $url .= "&joint={$param["subdata"]}";
        if (array_key_exists ('filterType', $param)) $url .= "&ref={$param['filterType']}&refdata={$param['subfilter']}";
        //var_dump ($url);
        $serverResponse = json_decode ($this->curl->request ("get", $url, $this->curlOpts)->getBody (), TRUE);
        if ($serverResponse['status'] === 200 && array_key_exists ('data', $serverResponse)) {
           $payload        = unserialize (base64_decode ($serverResponse['data']['payload']));
           if ($toDataTable) $payload = $this->asDataTableFormat ($payload);
        }
        return $serverResponse['status'];
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::createData()
     */
    public function createData (array $data, array &$response, string $userData = ""): int {
        $assetResponse  = array ();
        $convertedDate  = date_parse ($data['newfa-acquireddate']);
        $data['newfa-acquireddate'] = "{$convertedDate['year']}-{$convertedDate['month']}-{$convertedDate['day']}";
        $status = parent::createData ($data, $assetResponse, $userData);
        if ($status === 200) {
            $api        = 'fa-attributes';
            $assetUUID  = base64_encode ($assetResponse['uuid']);
            $attrVals   = $data['newfa-attributes'];
            $newfaAttrs = array ();
            foreach ($data['newfa-attributesid'] as $key => $attrID) $newfaAttrs[$attrID] = $attrVals[$key];
            $url        = $this->getServerURL ("{$api}?{$this->getUserKeyname ($userData)}");
            $this->curlOpts['json'] = array (
                'newfa-uuid'    => $assetUUID,
                'newfa-attrs'   => $newfaAttrs,
            );
            $theResponse    = json_decode ($this->curl->request ('post', $url, $this->curlOpts)->getBody (), TRUE);
            if ($theResponse['status'] === 200) {
                $payload    = unserialize (base64_decode ($theResponse['data']['payload']));
                $response['payload'][0] = $assetResponse;
                $response['payload'][1] = $payload;
            }
        }
        return $status;
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::asDataTableFormat()
     */
    public function asDataTableFormat (array $params): array {
        $output = array ();
        foreach ($params as $k => $asset) {
            $assetCode  = $asset['code'];
            $codeCol    = "<a id=\"openModalDetails\" class=\"d-hidden\" data-bs-toggle=\"modal\" data-bs-target=\"#modalDetail\"></a><span data-loadsource=\"serial\">{$assetCode}</span>";
            $output[$k] = array (
                $this->generateFirstColumn (($k+1), $assetCode),
                "<span data-loadsource=\"config\">{$asset['config']['dscript']}</span>",
                $codeCol,
                "<span data-loadsource=\"dscript\">{$asset['name']}</span>",
                "<span data-loadsource=\"asset_total\">{$asset['qty']}</span>",
            );
        }
        
        return $output;
    }
    
}