<?php
namespace App\Libraries;


class PageMapping {
    
    private $pageMap    = array (
        'welcome'           => 'frontpage',
        'master-asset'      => 'system-assets',
        'locations'         => 'registered-locations',
        'acl'               => 'access',
        'users'             => 'users-table',
        'profile'           => 'user-detail',
        'file-manager'      => 'fmanager',
        'categories'        => 'ci_categories',
        'properties'        => 'ci_attributes',
        'about'             => 'system-information',
        'settings'          => 'system-configuration',
        'documentation'     => 'manual'
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