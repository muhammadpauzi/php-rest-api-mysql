<?php

namespace App\Controllers;

use App\Databases\Database;
use App\Helpers\Response;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use App\Services\PostService;

class PostController
{
    private PostService $postService;

    public function __construct()
    {
        $db = Database::getDatabase();
        $postRepository = new PostRepository($db);
        $userRepository = new UserRepository($db);
        $this->postService = new PostService($postRepository, $userRepository);
    }

    public function posts()
    {
        $search_keyword = $_GET['q'] ?? '';
        $posts = $this->postService->posts($search_keyword);
        return Response::successResponse([
            "total" => count($posts),
            "data"  => $posts
        ]);
    }

    public function post(int $id)
    {
        $post = $this->postService->post($id);
        return Response::successResponse(["data" => $post]);
    }
}
