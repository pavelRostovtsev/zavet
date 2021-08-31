<?php
declare(strict_types=1);

namespace app\models;
use app\core\CoreModel;
use app\core\DBDriver;
use PDO;


class ArticleModel extends CoreModel
{
    protected string $table = 'articles';

    public function __construct(DBDriver $dbDriver)
    {
        $this->dbDriver = $dbDriver;
    }
}