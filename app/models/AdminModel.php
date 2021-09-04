<?php
declare(strict_types=1);

namespace app\models;
use app\core\CoreModel;
use app\core\DBDriver;
use PDO;


class AdminModel extends CoreModel
{
    protected string $table = 'users';

    public function __construct(DBDriver $dbDriver)
    {
        $this->dbDriver = $dbDriver;
    }
}