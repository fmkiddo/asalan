<?php
namespace App\Models;


class Sublocations extends BaseModel {
    
    protected $api      = "sublocations";
    protected $modal    = "sublocationForm";
    protected $fadeTarget = "faded-sublocations";
    protected $paramMap = array (
        'input-newloccode'  => 'newsbl-loccode',
        'input-newcode'     => 'newsbl-code',
        'input-newname'     => 'newsbl-name',
    );
    protected $columns  = array (
        'code', 'name'
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
        )
    );
    
    /**
     * 
     * {@inheritDoc}
     * @see \App\Models\BaseModel::asDataTableFormat()
     */
    protected function asDataTableFormat(array $params): array {
        $output = array ();
        $i = 1;
        foreach ($params as $k => $row) {
            $output[$k]  = array (
                $this->generateFirstColumn ($i, base64_encode($row['uuid'])),
                "<span data-loadsource=\"sblcode\">{$row['code']}</span>",
                "<span data-loadsource=\"sblname\">{$row['name']}</span>",
                $this->generateCreatedColumnOpenForm ($row['uuid'], $row['created_at'], FALSE, FALSE),
            );
            $i++;
        }
        return $output;
    }

}