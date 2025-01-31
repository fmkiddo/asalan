<?php
namespace App\Models;


class AssetProcure extends BaseModel {
    
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
    
    protected function asDataTableFormat(array $params): array {
        return array ();
    }
}