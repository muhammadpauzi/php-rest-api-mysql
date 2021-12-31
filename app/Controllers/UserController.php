<?php

namespace App\Controllers;

use App\Databases\Database;
use App\Helpers\Response;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $db = Database::getDatabase();
        $userRepository = new UserRepository($db);
        $postRepository = new PostRepository($db);
        $this->userService = new UserService($userRepository, $postRepository);
    }

    public function users()
    {
        $search_keyword = $_GET['q'] ?? '';
        $users = $this->userService->users($search_keyword);
        return Response::successResponse(["data" => $users]);
    }

    public function user(int $id)
    {
        $users = $this->userService->user($id);
        return Response::successResponse(["data" => $users]);
    }

    public function userWithPosts(int $id)
    {
        $users = $this->userService->userWithPosts($id);
        return Response::successResponse(["data" => $users]);
    }
}
