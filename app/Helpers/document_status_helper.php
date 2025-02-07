<?php
if (! function_exists ('mutating_document_status')) {
    
    function mutating_document_status (int $code, string $lang='id') {
        $string = '';
        switch ($code) {
            default:
                $text   = lang ("Dashboard.status.0", [], $lang); // Pending
                $string = "<span class=\"text-warning fw-bold\"><i class=\"mdi mdi-update\"></i> {$text}</span>";
                break;
            case -1:
                $text   = lang ("Dashboard.status.5", [], $lang); // Declined
                $string = "<span class=\"text-danger fw-bold\"><i class=\"mdi mdi-close-circle\"></i> {$text}</span>";
                break;
            case 1:
                $text   = lang ("Dashboard.status.1", [], $lang); // Approved
                $string = "<span class=\"text-success fw-bold\"><i class=\"mdi mdi-check-decagram\"></i> {$text}</span>";
                break;
            case 2:
                $text   = lang ("Dashboard.status.2", [], $lang); // Sent
                $string = "<span class=\"text-info fw-bold\"><i class=\"mdi mdi-truck\"></i> {$text}</span>";
                break;
            case 3:
                $text   = lang ("Dashboard.status.3", [], $lang); // Received
                $string = "<span class=\"text-warning fw-bold\"><i class=\"mdi mdi-receipt-text-clock\"></i> {$text}</span>";
                break;
            case 4:
                $text   = lang ("Dashboard.status.4", [], $lang); // Distributed
                $string = "<span class=\"text-success fw-bold\"><i class=\"mdi mdi-warehouse\"></i> {$text}</span>";
                break;
        }
        return $string;
    }
}