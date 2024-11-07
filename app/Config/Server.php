<?php
namespace Config;


use CodeIgniter\Config\BaseConfig;

class Server extends BaseConfig {
    
    public ?string $server_url      = 'http://192.168.128.253/';
    
    public ?string $infix_url       = 'api/osam/';
    
    public ?string $brandLogoURL    = '';
}