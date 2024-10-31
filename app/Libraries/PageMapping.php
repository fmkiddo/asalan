<?php
namespace App\Libraries;


class PageMapping {
    
    private $pageMap    = array (
        'welcome'           => 'frontpage',
        'profile'           => 'user-detail',
        'about'             => 'system-information',
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