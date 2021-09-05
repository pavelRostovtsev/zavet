<?php
declare(strict_types=1);

namespace app\core;

use app\core\Session;

class Flash
{
    /**
     * @param $name
     * @param string $string
     * @return null|string|array|int
     */
    public static function flash($name, $string = ''): null|string|array|int
    {
        if(Session::exists($name) && Session::get($name) !=='') {
            $session = Session::get($name);
            Session::delete($name);
            return $session;
        } else {
             Session::put($name,$string);
             return null;
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public static function existsFlash($name): bool
    {   if (array_key_exists($name, $_SESSION)) {
            return ($_SESSION[$name] == '') ? true:false;
        }
        return true;
    }
}