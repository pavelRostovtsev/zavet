<?php
declare(strict_types=1);

namespace app\core;

use PDO;

class DBDriver
{
    const FETCH_ALL = 'all';
    const FETCH_ONE = 'one';

    /**
     * DBDriver constructor.
     * @param PDO $pdo
     */
    public function __construct(private PDO $pdo){}

    /**
     * @param string $sql
     * @param array $params
     * @param string $fetch
     * @return mixed
     */
    public function select(string $sql, array $params = [], string $fetch = self::FETCH_ALL): mixed
    {
        $stmt = $this->pdo->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':'.$key, $val, $type);
            }
        }
        $stmt->execute();

        return $fetch === self::FETCH_ALL ?
            $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $table
     * @param array $params
     * @return int
     */
    public function insert(string $table, array $params= []): int
    {
        // $params - ассоциативный массив, в ключе у нас столбец бд а в значении передаваймый параметр
        $colums = sprintf('(%s)', implode(',', array_keys($params)));
        $masks = sprintf('(:%s)', implode(', :', array_keys($params)));

        $sql = sprintf('INSERT INTO %s %s VALUES %s', $table, $colums,$masks);

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return (int)$this->pdo->LastInsertId();
    }

    /**
     * @param $table
     * @param array $where
     */
    public function delete(string $table, array $where= []): void
    {

        if (count($where) === 3) {

            $operators = ["=" , '>', '<' , '>=', '<=' ];
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];
            if(in_array($operator, $operators))
            {
                $sql = sprintf('DELETE FROM %s WHERE %s %s ?', $table, $field, $operator);
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(1,$value);
                $stmt->execute();
            }
        }

    }

    /**
     * @param $table
     * @param array $params
     * @param array $where
     * @return bool
     */
    public function update($table, array $params, $where = []): bool
    {
        if (!empty($params) ) {
            $i = 1;
            $updateValue = [];
            foreach ($params as $column => $value) {
                $updateValue[$i] = sprintf("%s = '%s'",$column,$value);
                $i++;
            }
            $updateValue = implode(',', $updateValue);

            if(empty($where)){
                $sql = sprintf('UPDATE %s SET %s', $table,$updateValue);
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                return true;
            } elseif(count($where) === 3) {

                $operators = ["=" , '>', '<' , '>=', '<=' ];
                $field = $where[0];
                $operator = $where[1];
                $value = $where[2];
                if(in_array($operator, $operators)) {

                    $sql = sprintf('UPDATE %s SET %s WHERE %s %s ?', $table,$updateValue, $field, $operator);
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->bindValue(1,$value);
                    $stmt->execute();
                }

            }
        }

    }

    public function column($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':'.$key, $val, $type);
            }
        }
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}