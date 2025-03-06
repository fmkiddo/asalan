<?php
namespace App\Libraries;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\I18n\Time;

class CURLRequestMapper {
    
    private $modelMapping   = array (
        'users'                 => 'App\Models\Users',
        'user-allocation'       => 'App\Models\LocationSelect',
        'user-locations'        => 'App\Models\UserLocations',
        'profile'               => 'App\Models\Profile',
        'master-asset'          => 'App\Models\Assets',
        'location-assets'       => 'App\Models\AssetLocation',
        'asset-map'             => 'App\Models\AssetMap',
        'asset-picks'           => 'App\Models\AssetPicker',
        'acl'                   => 'App\Models\AccessControl',
        'categories'            => 'App\Models\ConfigItem',
        'config'                => 'App\Models\ConfigItem',
        'attr'                  => 'App\Models\Attributes',
        'attributes'            => 'App\Models\Attributes',
        'ciattributes'          => 'App\Models\ConfigItemAttributes',
        'locations'             => 'App\Models\Locations',
        'sublocations'          => 'App\Models\Sublocations',
        'sublocation'           => 'App\Models\Sublocations',
        'flow-request'          => 'App\Models\Request',
        'faprocuren'            => 'App\Models\Procurement',
        'faprocurex'            => 'App\Models\Procurement',
        'flow-asset-procure'    => 'App\Models\Procurement',
        'flow-asset-out'        => 'App\Models\TransferOut',
        'fatransfer'            => 'App\Models\TransferOut',
        'flow-asset-in'         => 'App\Models\AssetReceive'
    );
    
    public function __construct () { }
    
    /**
     * 
     * @param string $router
     * @return boolean|string
     */
    public function getTargetModelName (string $router) {
        if (!array_key_exists ($router, $this->modelMapping)) return FALSE;
        return $this->modelMapping[$router];
    }
    
    /**
     * 
     * @param string $key
     * @return boolean
     */
    public function isIgnoredKeys (string $key) {
        $ignored = FALSE;
        if ($key === 'created_at' || $key === 'created_by' || $key === 'updated_at' || $key === 'updated_by') $ignored = TRUE;
        return $ignored;
    }
}