<?php
namespace App\Libraries;


class PageMapping {
    
    private $pageMap    = array (
        'welcome'               => 'frontpage',
        'master-asset'          => 'system-assets',
        'locations'             => 'registered-locations',
        'flow-request'          => 'asset-requests',
        'flow-asset-procure'    => 'asset-procure',
        'flow-asset-out'        => 'asset-transfer',
        'flow-asset-in'         => 'asset-receive',
        'flow-asset-del'        => 'asset-removal',
        'maintenance'           => 'maintenance',
        'acl'                   => 'access',
        'users'                 => 'users-table',
        'profile'               => 'user-detail',
        'file-manager'          => 'fmanager',
        'categories'            => 'ci_categories',
        'about'                 => 'system-information',
        'settings'              => 'system-configuration',
        'documentation'         => 'manual'
    );
    
    /**
     * 
     * @param string $key   the key route from get value
     * @return string|bool  return the page file mapped to route
     * or return false if the route not available
     */
    public function mapRoute (string $key): string|bool {
        if (array_key_exists($key, $this->pageMap)) return $this->pageMap[$key];
        return FALSE;
    }
}