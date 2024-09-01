<?php

use App\Controllers\AuthController;
use App\Controllers\Dashboard;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login', [AuthController::class, 'login']);
$routes->get('logout', [AuthController::class, 'logout']);
$routes->post('login/attempt', [AuthController::class, 'attempt']);

$routes->get('dashboard', [Dashboard::class, 'index']);

