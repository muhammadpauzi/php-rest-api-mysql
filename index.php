<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Router;

Router::get('/', [UserController::class, 'users']);

Router::run();
