<?php
namespace App\Models;


class UserLocations extends Locations {
    
    protected $api      = "user-locations";
    
    protected function asDataTableFormat(array $params): array {
        return [];
    }
}