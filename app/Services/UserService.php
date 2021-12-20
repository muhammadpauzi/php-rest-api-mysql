<?php

namespace App\Services;

use App\Databases\Database;
use App\Helpers\Response;
use App\Repositories\UserRepository;
use Exception;

class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function users()
    {
        try {
            Database::beginTransaction();
            // get users through repository
            $users = $this->userRepository->findAll();
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
}
