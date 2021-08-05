<?php

namespace App\Core;

class Errors
{

    public function error_404()
    {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
}
