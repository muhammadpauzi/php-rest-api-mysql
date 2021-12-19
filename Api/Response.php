<?php
class Response
{
    private static function json(array|string $data = "")
    {
        header("Content-Type: application/json");
        echo json_encode($data);
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
}
