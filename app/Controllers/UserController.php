<?php

namespace App\Controllers;

use App\Databases\Database;
use App\Helpers\Response;
use App\Repositories\UserRepository;
use App\Services\UserService;

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $db = Database::getDatabase();
        $userRepository = new UserRepository($db);
        $this->userService = new UserService($userRepository);
    }

    public function users()
    {
        $users = $this->userService->users();
        return Response::successResponse(["data" => $users]);
    }

    public function user(int $id)
    {
        $users = $this->userService->user($id);
        return Response::successResponse(["data" => $users]);
    }
}
