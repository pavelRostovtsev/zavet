<?php

namespace app\core;

class CSRF
{

    const TOKEN_NAME = 'csrf';

    /**
     * @return mixed
     */
	public static function generate(): mixed
    {
	    return Session::put(CSRF::TOKEN_NAME, md5(uniqid()));
	}

    /**
     * @param $token
     * @return bool
     */
	public static function check ($token): bool
    {
		if (Session::exists(CSRF::TOKEN_NAME) && $token == Session::get(CSRF::TOKEN_NAME)) {
			Session::delete(CSRF::TOKEN_NAME);
			return true;
		}
		return false;
	}
}
