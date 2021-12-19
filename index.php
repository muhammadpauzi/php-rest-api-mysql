<?php
require_once __DIR__ . "/App/Router.php";

use App\Router;

class asas
{
    public function asd($data = "")
    {
        echo "<br>DATA<br>";
        var_dump($data);
    }
}

Router::get('/asd', asas::class, 'asd');

Router::run();
