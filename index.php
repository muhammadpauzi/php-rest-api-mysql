<?php
require_once __DIR__ . "/App/Router.php";
require_once __DIR__ . "/Api/Response.php";
require_once __DIR__ . "/Controllers/UserController.php";

Router::get('/', [UserController::class, 'users']);

Router::run();
