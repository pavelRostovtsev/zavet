<?php

namespace app\core;

class Session
{

    /**
     * @param $name
     * @param $value
     * @return mixed
     */
	public static function put($name, $value): mixed
    {
		return $_SESSION[$name] = $value; 
	}

    /**
     * @param $name
     * @return bool
     */
	public static function exists($name): bool
    {
		return isset($_SESSION[$name]);
	}

    /**
     * @param $name
     * @return void
     */
	public static function delete($name):void
    {
		if(self::exists($name)) {
			unset($_SESSION[$name]);
		}
	}

    /**
     * @param $name
     * @return mixed
     */
	public static function get($name): mixed
    {
        return $_SESSION[$name];
    }


}