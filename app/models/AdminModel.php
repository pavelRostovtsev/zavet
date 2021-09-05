<?php
declare(strict_types=1);

namespace app\models;

use app\core\CoreModel;
use app\core\DBDriver;
use PDO;


class AdminModel extends CoreModel
{
    /**
     * @var array|bool[][]
     */
    private array $rules = [
        'password' => [
            'required' => true,
            'max'      => 30,
            'min'      => 5,
        ],
        'name' => [
            'required' => true,
            'max'      => 30,
            'min'      => 5,
        ],
    ];

    /**
     * @var string
     */
    protected string $table = 'users';

    /**
     * AdminModel constructor.
     * @param DBDriver $dbDriver
     */
    public function __construct(protected DBDriver $dbDriver){}

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param $name
     * @return array|null
     */
    public function findByName($name): array|null
    {
        $params = [
            'name' => $name,
        ];
        $data = $this->dbDriver->select("SELECT * FROM {$this->table} WHERE name = :name", $params);

        if (!empty($data)) {
            return $data[0];
        }
        return null;

    }

}