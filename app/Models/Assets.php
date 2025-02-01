<?php
namespace App\Models;


class Assets extends BaseModel {
    
    protected $api      = "fixed-assets";
    protected $modal    = "modalAssetForm";
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
        $i = 1;
        $isJoint = FALSE;
        foreach ($params as $k => $row) {
            if ($k === 'joint') $isJoint = $row;
            else {
                $assetCode  = $row['asset_code'];
                if (!$isJoint) 
                    $output[$k] = array (
                        $this->generateFirstColumn ($i, $assetCode),
                        "<span data-loadsource=\"config\">{$row['asset_config']}</span>",
                        "<a id=\"openModalDetails\" class=\"d-hidden\" data-bs-target=\"#modalDetail\" data-bs-toggle=\"modal\" data-target=\"{$row['asset_code']}\"></a><span data-loadsource=\"serial\">{$row['asset_code']}</span>",
                        "<span data-loadsource=\"dscript\">{$row['asset_dscript']}</span>",
                        "<span data-loadsource=\"asset_total\">{$row['asset_total']}</span>",
                    );
                elseif (!array_key_exists ('asset_location', $row))
                    $output[$k] = array (
                        $this->generateFirstColumn ($i, $assetCode),
                        "<span data-loadsource=\"serial\">{$row['asset_code']}</span>",
                        "<span data-loadsource=\"dscript\">{$row['asset_dscript']}</span>",
                        "<span data-loadsource=\"config\">{$row['asset_config']}</span>",
                        "<span data-loadsource=\"sublocation\">{$row['asset_subloc']}</span>",
                        "<span data-loadsource=\"asset_total\">{$row['asset_total']}</span>",
                    );
                else
                    $output[$k] = array (
                        $this->generateFirstColumn ($i, $assetCode),
                        "<span data-loadsource=\"location\">{$row['asset_location']}</span>",
                        "<span data-loadsource=\"sublocation\">{$row['asset_subloc']}</span>",
                        "<span data-loadsource=\"asset_total\">{$row['asset_total']}</span>",
                    );
                $i++;
            }
        }
        return $output;
    }
    
}