<?php

use App\Controllers\AuthController;
use App\Controllers\Dashboard;
use App\Controllers\VisitController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login', [AuthController::class, 'login']);
$routes->get('logout', [AuthController::class, 'logout']);
$routes->post('login/attempt', [AuthController::class, 'attempt']);

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', [Dashboard::class, 'index']);

    $routes->get('visit/(:segment)', [VisitController::class, 'index']);
    $routes->post('visit/single-submit', [VisitController::class, 'singleSubmit']);

});
