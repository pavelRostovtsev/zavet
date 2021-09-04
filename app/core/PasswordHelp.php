<?php

namespace app\core;

class PasswordHelp
{
    /**
     * @param $password
     * @param string $algo
     * @return bool|string|null
     */
    public static function passHash($password, $algo = PASSWORD_DEFAULT): bool|string|null
    {
        return password_hash($password, $algo);
    }

    /**
     * @param $password
     * @param $hash
     * @return bool
     */
    public static function passCheck($password, $hash): bool
    {
        return password_verify($password, $hash);
    }
}