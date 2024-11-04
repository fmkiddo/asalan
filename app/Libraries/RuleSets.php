<?php
namespace App\Libraries;


class RuleSets {
    
    private $rules  = array (
        'profile'       => array (
            'input-fname'   => array (
                'rules'         => 'required',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
            'input-addr1'   => array (
                'rules'         => 'required',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
            'input-phone'   => array (
                'rules'         => 'required|numeric',
                'errors'        => array (
                    'required'      => '',
                    'numeric'       => ''
                ),
            ),
            'input-email'   => array (
                'rules'         => 'required|valid_email',
                'errors'        => array (
                    'required'      => '',
                    'valid_email'   => ''
                ),
            )
        )
    );
    
    public function __construct () { }
    
    /**
     * 
     * @param string $router
     * @return boolean|string[][]|string[][][]
     */
    public function getRuleSets (string $router) {
        if (!array_key_exists ($router, $this->rules)) return FALSE;
        return $this->rules[$router];
    }
}