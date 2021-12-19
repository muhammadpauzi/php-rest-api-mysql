<?php

namespace App\Controllers;

use Response;

class UserController
{
    public function users()
    {
        return Response::successResponse(["message" => "Hello World"]);
    }
}
