<?php
declare(strict_types=1);


namespace app\core;


class Support
{
    /**
     * @return int
     */
    public static function rand(): int
    {
        return mt_rand(0, 10000);
    }
}