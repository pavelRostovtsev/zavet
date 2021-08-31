<?php
declare(strict_types=1);


namespace app\core;

use PDO;

class BaseRepository
{
    /**
     * @var DBDriver
     */
    protected DBDriver $dbDriver;

    /**
     * @var string
     */
    protected string $table;

    /**
     * BaseRepository constructor.
     * @param $dbDriver
     * @param $table
     */
    public function __construct(DBDriver $dbDriver, string $table)
    {
        $this->dbDriver = $dbDriver;
        $this->table = $table;
    }

    /**
     * @return DBDriver
     */
    protected function getDbDriver(): DBDriver
    {
        return $this->dbDriver;
    }

    /**
     * @return string
     */
    protected function getTable(): string
    {
        return $this->table;
    }

    /**
     * @return int
     */
    public function findCount(): int
    {
        return $this->dbDriver->column("SELECT COUNT(id) FROM {$this->table}");
    }

    /**
     * @param array $route
     * @param string $parameter
     * @param string $sort
     * @return mixed
     */
    public function findAll(array $route, string $parameter, string $sort): mixed
    {
        $max = 8;
        $params = [
            'max' => $max,
            'start' => ((($route['page'] ?? 1) - 1) * $max),
        ];

        return $this->
            dbDriver->
            select("SELECT * FROM {$this->table} ORDER BY {$parameter} {$sort} LIMIT :start, :max", $params);
    }

    /**
     * @param $post
     * @return int
     */
    public function insert($post): int
    {
        $params = [];
        $dataPost = $_POST;
        foreach ($dataPost as $key => $data) {
            if ($key === 'csrf') continue;
            $params[$key] = $data;
        }
        return $this->dbDriver->insert($this->table,$params);
    }

    /**
     * @param $id
     * @return mixed
     * заменить на селект, ибо дублируется логика
     */
    public function isRecordExists($id): mixed
    {
        $params = [
            'id' => $id,
        ];
        return $this->dbDriver->column("SELECT id FROM {$this->table} WHERE id = :id",$params);
    }

    public function findId($id)
    {
        $params = [
            'id' => $id,
        ];
        return $this->dbDriver->select("SELECT * FROM {$this->table} WHERE id = :id", $params);
    }

    public function update($id)
    {
        $params = [];
        $dataPost = $_POST;
        foreach ($dataPost as $key => $data) {
            if ($key === 'csrf') continue;
            if ($key === 'id') continue;
            $params[$key] = $data;
        }
        $this->dbDriver->update($this->table,$params,
            [
                'id',
                '=',
                $id
            ]);
    }
    public function delete($id)
    {
        $where = [
            'id',
            '=',
            $id
        ];
        $this->dbDriver->delete($this->table,$where);
    }


}