<?php
namespace App\Libraries;


class RuleSets {
    
    public function __construct ($locale="id") {
        $this->rules    = array (
            'profile'       => array (
                'new'           => array (
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
                            'numeric'       => '',
                        ),
                    ),
                    'input-email'   => array (
                        'rules'         => 'required|valid_email',
                        'errors'        => array (
                            'required'      => '',
                            'valid_email'   => '',
                        ),
                    ),
                ),
                'edit'          => array (
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
                            'numeric'       => '',
                        ),
                    ),
                    'input-email'   => array (
                        'rules'         => 'required|valid_email',
                        'errors'        => array (
                            'required'      => '',
                            'valid_email'   => '',
                        ),
                    ),
                ),
            ),
            'users'         => array (
                'new'           => array (
                    'input-uname'   => array (
                        'rules'         => 'required',
                        'errors'        => array (
                            'required'      => '',
                        )
                    ),
                    'input-email'   => array (
                        'rules'         => 'required|valid_email',
                        'errors'        => array (
                            'required'      => '',
                        )
                    ),
                    'input-cemail'  => array (
                        'rules'         => 'required|matches[input-email]|valid_email',
                        'errors'        => array (
                            'required'      => '',
                        )
                    ),
                    'input-pswd'    => array (
                        'rules'         => 'required|strong_password|min_length[8]',
                        'errors'        => array (
                            'required'          => '',
                            'strong_password'   => '',
                            'min_length'
                        )
                    ),
                    'input-cpswd'   => array (
                        'rules'         => 'required|matches[input-pswd]',
                        'errors'        => array (
                            'required'      => '',
                            'matches'       => '',
                        ),
                    ),
                ),
                'edit'          => array (
                    'input-uname'   => array (
                        'rules'         => 'required',
                        'errors'        => array (
                            'required'      => '',
                        )
                    ),
                    'input-email'   => array (
                        'rules'         => 'required|valid_email',
                        'errors'        => array (
                            'required'      => '',
                        )
                    ),
                    'input-cemail'  => array (
                        'rules'         => 'required|matches[input-email]|valid_email',
                        'errors'        => array (
                            'required'      => '',
                        )
                    ),
                )
            ),
            'acl'           => array (
                'new'           => array (
                    'input-groupcode'   => array (
                        'rules'         => 'required',
                        'errors'        => array (
                            'required'      => ''
                        ),
                    ),
                    'input-groupdscript'    => array (
                        'rules'         => 'required',
                        'errors'        => array (
                            'required'      => ''
                        )
                    )
                ),
                'edit'          => array (
                    'input-groupcode'   => array (
                        'rules'         => 'required',
                        'errors'        => array (
                            'required'      => ''
                        ),
                    ),
                    'input-groupdscript'    => array (
                        'rules'         => 'required',
                        'errors'        => array (
                            'required'      => ''
                        )
                    )
                ),
            ),
        );
    }
    
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