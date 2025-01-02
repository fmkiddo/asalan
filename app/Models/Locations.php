<?php
namespace App\Models;


class Locations extends BaseModel {
    
    protected $api      = "locations";
    protected $modal    = "modalLocationForm";
    protected $paramMap = array (
        'input-newcode'         => 'newloc-code',
        'input-newname'         => 'newloc-name',
        'input-newphone'        => 'newloc-phone',
        'input-newaddr'         => 'newloc-addr',
        'input-newcontact'      => 'newloc-contactp',
        'input-newemail'        => 'newloc-email',
        'input-newnotes'        => 'newloc-notes',
    );
    protected $columns  = array (
        'code', 'name', 'phone', 'addr', 'contact_person', 'email', 'notes'
    );
    protected $rulesets = array (
        'new'   => array (
            'input-newcode'     => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-newname'     => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-newaddr'     => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-newcontact'     => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
        ),
        'edit'  => array (
            'input-newcode'     => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-newname'     => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-newaddr'     => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
            'input-newcontact'     => array (
                'rules'             => 'required',
                'errors'            => array (
                    'required'          => '',
                ),
            ),
        )
    );
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::asDataTableFormat()
     */
    protected function asDataTableFormat (array $params): array {
        $output = array ();
        $i = 1;
        foreach ($params as $k => $row) {
            $output[$k]  = array (
                $this->generateFirstColumn ($i, base64_encode($row['uuid'])),
                "<span data-loadsource=\"code\">{$row['code']}</span>",
                "<span data-loadsource=\"name\">{$row['name']}</span>",
                "<span data-loadsource=\"address\">{$row['addr']}</span>",
                "<span data-loadsource=\"phone\">{$row['phone']}</span>",
                "<span data-loadsource=\"contact-person\">{$row['contactp']}</span>",
                "<span data-loadsource=\"email\">{$row['email']}</span>",
                "<span data-loadsource=\"notes\">{$row['notes']}</span>",
                $this->generateCreatedColumn($row['uuid'], $row['created_at'], TRUE, FALSE),
            );
            $i++;
        }
        return $output;
    }
    
}