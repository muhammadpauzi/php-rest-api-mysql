<?php

namespace App\Services;

use App\Databases\Database;
use App\Helpers\Response;
use App\Respositories\UserRepository;
use Exception;

class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function users(): array
    {
        try {
            Database::beginTransaction();
            // get users through repository
            $users = $this->userRepository->findAll();
            // if users does not exists
            if (!$users)
                return Response::notFoundResponse([
                    "message" => "USERS_NOT_FOUND"
                ]);
            return $users;
            Database::commitTransaction();
        } catch (Exception $e) {
            Database::rollbackTransaction();
            return Response::serverErrorResponse(
                data: [
                    "message" => $e->getMessage()
                ]
            );
            throw $e;
        }
    }
}
