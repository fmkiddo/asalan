<?php
namespace App\Models;


use CodeIgniter\I18n\Time;

class Request extends BaseModel {
    
    
    protected $api      = "fa-request-sum";
    protected $modal    = "modalDetail";
    protected $paramMap = array (
    );
    protected $columns  = array (
    );
    
    protected function asDataTableFormat(array $params): array {
        helper ('document_status');
        $output = array ();
        foreach ($params as $k => $row) {
            $i          = $k+1;
            $data       = base64_encode ($row['uuid']);
            $date       = new Time($row['docdate']);
            $detailCol  = "<a class=\"d-hidden\" data-action=\"open-dialog\" data-action-target=\"#modalDetail\"></a><span data-load-source=\"docnum\">{$row['docnum']}</span>";
            $dateFormat = ($this->locale === 'id' ? 'dd MMMM yyyy' : 'MMMM dd, yyyy');
            $doctype    = lang ("Dashboard.reqtype.{$row['doctype']}", [], $this->locale);
            $appName    = ($row['userdata']['name'] === '' || $row['userdata']['name'] === NULL) ? $row['userdata']['username']
                : $row['userdata']['name'];
            array_push ($output, array (
                $this->generateFirstColumn ($i, $data),
                $detailCol,
                "<span data-loadsource=\"docdate\">{$date->toLocalizedString ($dateFormat)}</span>",
                "<span data-loadsource=\"doctype\">{$doctype}</span>",
                "<span data-loadsource=\"applicant_name\">{$appName}</span>",
                mutating_document_status ($row['status'], $this->locale),
            ));
        }
        return $output;
    }
}