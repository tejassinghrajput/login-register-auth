<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->post('/api/auth/login', 'LoginController::verifyUser');
$routes->post('api/auth/userRegistration', 'RegisterController::registerUser');

$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'jwtAuth']);