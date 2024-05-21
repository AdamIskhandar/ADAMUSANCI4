<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'Auth::register');
$routes->get('/login', 'Auth::login');
$routes->get('/dashboard', 'User::dashboard');
$routes->get('/about', 'User::about');
$routes->get('/logout/auth', 'Auth::logout_auth');
$routes->post('/register/auth', 'Auth::register_auth');
$routes->post('/login/auth', 'Auth::login_auth');
