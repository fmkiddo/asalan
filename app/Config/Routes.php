<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->match (['get', 'post'], '/', 'Home::index');
$routes->match (['get', 'post'], '/welcome', 'Welcome::index');

$routes->group ('osam', static function ($routes) {
    $routes->match (['get', 'post'], 'setup', 'SetupSystem::index');
});