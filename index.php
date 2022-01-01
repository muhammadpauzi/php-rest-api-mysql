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

// cors
function cors()
{

    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
}

cors();

// routes
Router::get('/users', [UserController::class, 'users']);
Router::get('/users/([0-9]*)', [UserController::class, 'user']);
Router::get('/users/([0-9]*)/posts', [UserController::class, 'userWithPosts']);

Router::get('/posts', [PostController::class, 'posts']);
Router::get('/posts/([0-9]*)', [PostController::class, 'post']);

Router::run();
