<?php
declare(strict_types=1);

namespace app\core;

use app\core\Patterns\Singleton\Singleton;
use PDO;

Class DB extends Singleton
{
    public static function getPDO(): PDO
    {
        $DBConfig = require "../config/DBConfig.php";

        return new PDO(
            "mysql:host=" . $DBConfig['host'] . "; dbname=". $DBConfig['dbname'] . "; charset=UTF8",
            $DBConfig['user'],
            $DBConfig['password']
        );
    }
}