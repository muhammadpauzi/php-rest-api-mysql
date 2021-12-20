<?php

namespace App\Services;

use App\Databases\Database;
use App\Helpers\Response;
use App\Respositories\UserRepository;
use Exception;

use const App\Constants\SERVER_ERROR_MESSAGE;
use const App\Constants\USERS_NOT_FOUND_MESSAGE;

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
                    "message" => USERS_NOT_FOUND_MESSAGE
                ]);
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
            throw $e;
        }
    }
}
