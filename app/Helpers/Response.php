<?php

namespace App\Helpers;

class Response
{
    private static function json(array|string $data = "")
    {
        header("Content-Type: application/json");
        echo json_encode($data);
        exit();
    }

    public static function setStatus(int $status = 200)
    {
        http_response_code($status);
        return Response::class;
    }

    public static function successResponse(array|string $data = ""): void
    {
        self::setStatus(200)::json($data);
    }

    public static function notFoundResponse(array|string $data = ""): void
    {
        self::setStatus(404)::json($data);
    }

    public static function serverErrorResponse(int $status = 500, array|string $data = ""): void
    {
        self::setStatus($status)::json($data);
    }
}
