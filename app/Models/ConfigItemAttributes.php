<?php
namespace App\Models;


class ConfigItemAttributes extends BaseModel {
    
    protected $api      = "ci-attributes";
    protected $modal    = "modalAssetForm";
    protected $paramMap = array (
    );
    protected $columns  = array (
    );
    protected $rulesets = array (
    );
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\Models\BaseModel::asDataTableFormat()
     */
    protected function asDataTableFormat(array $params): array {
        
    }

    
    
}