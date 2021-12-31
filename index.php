<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Controllers\PostController;
use App\Core\Router;
use App\Controllers\UserController;

// constants
require_once __DIR__ . '/app/Constants/database.php';
require_once __DIR__ . '/app/Constants/messages.php';

// routes
Router::get('/users', [UserController::class, 'users']);
Router::get('/users/([0-9]*)', [UserController::class, 'user']);

Router::get('/posts', [PostController::class, 'posts']);
Router::get('/posts/([0-9]*)', [PostController::class, 'post']);

Router::run();
