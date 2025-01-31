<?php
namespace App\Models;


class LocationSelect extends BaseModel {
    
    protected $api      = "user-allocations";
    protected $modal    = "";
    protected $paramMap = array (
        'input-userallocations' => 'newallocation-uuids'
    );
    protected $columns  = array (
    );
    protected $rulesets = array (
        'new'   => array (
            'atom'  => array (
                'rules'     => 'required',
                'errors'    => array (
                    'required'  => '',
                ),
            ),
        ),
        'edit'  => array (
        ),
    );
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::createData()
     */
    public function createData (array $data, array &$response, string $userData = ""): int {
        if (!array_key_exists ('newallocation-uuids', $data)) $data['newallocation-uuids'] = [];
        return parent::createData ($data, $response, $userData);
    }
    
    /**
     * {@inheritDoc}
     * @see \App\Models\BaseModel::getData()
     *//**
    public function getData (array &$payload, array $param, string $userData = "", bool $toDataTable = FALSE): int {
    }**/
    
    protected function asDataTableFormat(array $params): array {
        $output = array ();
        $i      = 1;
        foreach ($params as $k => $row) {
            $uid    = base64_encode ($row['uuid']);
            $check  = ($row['allocated'] === '1' ? 'checked="checked"' : '');
            $output[$k] = array (
                $this->generateFirstColumn ($i),
                "<input type=\"checkbox\" name=\"input-userallocations[]\" aria-labelledby=\"userLocations\" value=\"{$uid}\" {$check} />",
                $row['code'],
                $row['name'],
            );
            $i++;
        }
        return $output;
    }
}