<?php

namespace app\core;

use JetBrains\PhpStorm\NoReturn;

class Redirect
{
    #[NoReturn]
    public static function redirect($url)
    {
        header('location: /'.$url);
        exit;
    }
}