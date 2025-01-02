<?php
namespace App\Models;


class AccessControl extends BaseModel {
    
    protected $api      = "controller";
    protected $modal    = "modalFormControl";
    protected $paramMap = array (
        'input-groupcode'       => 'controlcode',
        'input-groupdscript'    => 'controlname',
        'input-groupcaprv'      => 'control-canapprove',
        'input-groupcremv'      => 'control-canremove',
        'input-groupcsend'      => 'control-cansend',
    );
    protected $columns  = array (
        "code", "name", "can_approve", "can_remove", "can_send", "created_at"
    );
    protected $rulesets = array (
        'new'           => array (
            'input-groupcode'   => array (
                'rules'         => 'required',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
            'input-groupdscript'    => array (
                'rules'         => 'required',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
        ),
        'edit'          => array (
            'input-groupcode'   => array (
                'rules'         => 'required',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
            'input-groupdscript'    => array (
                'rules'         => 'required',
                'errors'        => array (
                    'required'      => '',
                ),
            ),
        ),
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
            $textCA     = ($row['can_approve'] ? "<i class=\"mdi mdi-check-circle text-success\"></i>" : "<i class=\"mdi mdi-close-circle text-danger\"></i>");
            $textCD     = ($row['can_remove'] ? "<i class=\"mdi mdi-check-circle text-success\"></i>" : "<i class=\"mdi mdi-close-circle text-danger\"></i>");
            $textCS     = ($row['can_send'] ? "<i class=\"mdi mdi-check-circle text-success\"></i>" : "<i class=\"mdi mdi-close-circle text-danger\"></i>");
            $canApprove = $row['can_approve'] ? 'true' : 'false';
            $canDispose = $row['can_approve'] ? 'true' : 'false';
            $canSend    = $row['can_approve'] ? 'true' : 'false';
            $output[$k] = array (
                $this->generateFirstColumn ($i, base64_encode($row['uuid'])),
                "<span data-loadsource=\"gcode\">{$row['code']}</span>",
                "<span data-loadsource=\"gname\">{$row['name']}</span>",
                "<span data-loadsource=\"gcanapprove\" class=\"d-hidden\">{$canApprove}</span>{$textCA}",
                "<span data-loadsource=\"gcandispose\" class=\"d-hidden\">{$canDispose}</span>{$textCD}",
                "<span data-loadsource=\"gcantransfer\" class=\"d-hidden\">{$canSend}</span>{$textCS}",
                $this->generateCreatedColumn($row['uuid'], $row['created_at'], FALSE, FALSE),
            );
            $i++;
        }
        return $output;
    }
}