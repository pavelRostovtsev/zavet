<?php
declare(strict_types=1);

namespace app\models;

use app\core\CoreModel;
use app\core\DBDriver;


class ArticleModel extends CoreModel
{
    /**
     * @var string
     */
    protected string $table = 'articles';

    /**
     * @var array
     */
    private array $rules = [
        'title' => [
            'required' => true,
            'max'      => 100,
            'min'      => 5,
        ],
        'description' => [
            'required' => true,
            'max'      => 300,
            'min'      => 5,
        ],
        'text' => [
            'required' => true,
            'max'      => 300,
            'min'      => 5,
        ],
    ];

    /**
     * ArticleModel constructor.
     * @param DBDriver $dbDriver
     */
    public function __construct(DBDriver $dbDriver)
    {
        $this->dbDriver = $dbDriver;
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }
}