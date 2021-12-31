<?php

namespace App\Services;

use App\Databases\Database;
use App\Helpers\Response;
use App\Repositories\PostRepository;
use Exception;

class PostService
{
    public function __construct(private PostRepository $postRepository)
    {
    }

    public function posts(string $search_keyword = "")
    {
        try {
            Database::beginTransaction();
            $posts = [];
            // get posts through repository
            if ($search_keyword) {
                $posts = $this->postRepository->findAllBySearchKeyword($search_keyword);
            } else {
                $posts = $this->postRepository->findAll();
            }
            return $posts;
            Database::commitTransaction();
        } catch (Exception $e) {
            Database::rollbackTransaction();
            return Response::serverErrorResponse(
                data: [
                    "message" => SERVER_ERROR_MESSAGE,
                    "error" => $e->getMessage()
                ]
            );
        }
    }

    public function post(int $id)
    {
        try {
            Database::beginTransaction();
            // get posts through repository
            $post = $this->postRepository->findById($id);
            if (!$post)
                Response::notFoundResponse([
                    "message" => POST_NOT_FOUND_MESSAGE
                ]);
            return $post;
            Database::commitTransaction();
        } catch (Exception $e) {
            Database::rollbackTransaction();
            return Response::serverErrorResponse(
                data: [
                    "message" => SERVER_ERROR_MESSAGE,
                    "error" => $e->getMessage()
                ]
            );
        }
    }
}
