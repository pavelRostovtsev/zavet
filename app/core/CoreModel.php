<?php
declare(strict_types=1);

namespace app\core;

use \app\core\DBDriver;


class CoreModel
{
    protected string $table ;

    /**
     * CoreModel constructor.
     * @param DBDriver $dbDriver
     */
    public function __construct(protected DBDriver $dbDriver)
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
    /**
     * @return \app\core\DBDriver
     */
    protected function getDbDriver(): \app\core\DBDriver
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
        return (int)($this->dbDriver->column("SELECT COUNT(id) FROM {$this->table}"));
    }

    /**
     * @param string|null $page
     * @param string $parameter
     * @param string $sort
     * @return mixed
     */
    public function findAll(string|null $page, string $parameter, string $sort): mixed
    {
        $max = 10;
        $params = [
            'max' => $max,
            'start' => ((($page ?? 1) - 1) * $max),
        ];

        return $this->
        dbDriver->
        select("SELECT * FROM {$this->table} ORDER BY {$parameter} {$sort} LIMIT :start, :max", $params);
    }

    /**
     * @param $post
     * @return int
     */
    public function create($post): int
    {
        $params = [];
        $dataPost = $post;

        foreach ($dataPost as $key => $data) {
            if ($key === 'csrf') continue;
            $params[$key] = $data;
        }
        return $this->dbDriver->insert($this->table,$params);
    }

    /**
     * @param $id
     * @return mixed
     * ???????????????? ???? ????????????, ?????? ?????????????????????? ????????????
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