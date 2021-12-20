<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\UserController;
use App\Core\Router;

// routes
Router::get('/users', [UserController::class, 'users']);

Router::run();
