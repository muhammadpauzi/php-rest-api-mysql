<?php

namespace App\Services;

use App\Databases\Database;
use App\Helpers\Response;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Exception;

class UserService
{
    public function __construct(private UserRepository $userRepository, private PostRepository $postRepository)
    {
    }

    public function users(string $search_keyword = "")
    {
        try {
            Database::beginTransaction();
            $users = [];
            // get users through repository
            if ($search_keyword) {
                $users = $this->userRepository->findAllBySearchKeyword($search_keyword);
            } else {
                $users = $this->userRepository->findAll();
            }
            return $users;
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

    public function user(int $id)
    {
        try {
            Database::beginTransaction();
            // get users through repository
            $user = $this->userRepository->findById($id);
            if (!$user)
                Response::notFoundResponse([
                    "message" => USER_NOT_FOUND_MESSAGE
                ]);
            return $user;
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

    public function userWithPosts(int $id)
    {
        try {
            Database::beginTransaction();
            // get users through repository
            $user = $this->userRepository->findById($id);
            if (!$user)
                Response::notFoundResponse([
                    "message" => USER_NOT_FOUND_MESSAGE
                ]);
            $posts = $this->postRepository->findAllByUserID($id);
            $user["posts"] = $posts;
            return $user;
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
