<?php
declare(strict_types=1);

namespace app\core;

use PDO;

class CoreModel
{
    protected string|null $table = null;

    /**
     * CoreModel constructor.
     * @param $dbDriver
     */
    public function __construct(protected PDO $dbDriver)
    {
        $this->table = $this->setTableName();
    }

    /**
     * @return string
     */
    protected function setTableName(): string
    {
        if ($this->table === null) {
            $this->table = (new \ReflectionClass($this))->getShortName();
            $this->table= str_replace('Model', '',  $this->table);
            $this->table = strtolower(( $this->table . 's'));
        }
        return $this->table;
    }

    /**
     * @return string
     */
    protected function getTableName(): string
    {
        return $this->table;
    }
}