<?php
class UserController
{
    public function users()
    {
        return Response::successResponse(["message" => "Hello World"]);
    }
}
