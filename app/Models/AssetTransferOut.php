<?php
namespace App\Models;


class AssetTransferOut extends BaseModel {
    
    protected $api      = "fa-tsout";
    protected $modal    = "modalTsoutForm";
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
        return [];
    }
}