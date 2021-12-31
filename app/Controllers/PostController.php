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
        $offset = intval($_GET['offset'] ?? 0);
        $limit = intval($_GET['limit'] ?? 10);
        $sort = strtolower($_GET['sort'] ?? 'ASC');

        if ($sort !== "asc" || $sort !== 'desc')
            $sort = 'ASC';

        $posts = $this->postService->posts($search_keyword, $offset, $limit, $sort);
        return Response::successResponse([
            "total" => count($posts),
            "previous" => $offset <= 0 ? false : ["offset" => $offset - $limit],
            "next"  => count($posts) > 0 && count($posts) >= $limit ? ["offset" => $limit + $offset] : false,
            "data"  => $posts
        ]);
    }

    public function post(int $id)
    {
        $post = $this->postService->post($id);
        return Response::successResponse(["data" => $post]);
    }
}
