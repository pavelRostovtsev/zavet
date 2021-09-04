<?php

namespace app\core;

use app\core\Session;

class Flash
{
    /**
     * @param $name
     * @param string $string
     * @return mixed
     */
    public static function flash($name, $string = ''): mixed
    {
        if(Session::exists($name) && Session::get($name) !=='') {
            $session = Session::get($name);
            Session::delete($name);
            return $session;
        } else {
            Session::put($name,$string);
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public static function existsFlash($name): bool
    {
        return $_SESSION[$name] == '';
    }
}