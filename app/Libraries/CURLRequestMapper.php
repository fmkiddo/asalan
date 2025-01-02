<?php
namespace App\Libraries;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\I18n\Time;

class CURLRequestMapper {
    
    private $modelMapping   = array (
        "users"             => "App\Models\Users",
        "profile"           => "App\Models\Profile",
        "master-asset"      => "App\Models\Assets",
        "location-assets"   => "App\Models\Assets",
        "asset-subs"        => "App\Models\Assets",
        "acl"               => "App\Models\AccessControl",
        "categories"        => "App\Models\ConfigItem",
        "config"            => "App\Models\ConfigItem",
        "attr"              => "App\Models\Attributes",
        "attributes"        => "App\Models\Attributes",
        "ciattributes"      => "App\Models\ConfigItemAttributes",
        "locations"         => "App\Models\Locations",
        "sublocations"      => "App\Models\Sublocations",
        "sublocation"       => "App\Models\Sublocations",
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