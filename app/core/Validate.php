<?php
declare(strict_types=1);

namespace app\core;

use app\core\CoreModel;

class Validate
{
    /**
     * @var bool
     */
    private bool $passed = false;

    /**
     * @var array
     */
    private array $errors = [];

    /**
     * Validate constructor.
     * @param \app\core\CoreModel $model
     */
    public function __construct(private CoreModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $requests
     * @return Validate
     */
    public function check(array $requests): Validate
    {

        foreach ($this->model->getRules() as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {

                $value = $requests[$item];

                if ($rule =='required' && empty($value)) {
                    $this->addError("{$item} is required");
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError("{$item} минимальное кол-во символов {$rule_value}");
                            }
                            break;

                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("{$item} максимальное кол-во символов {$rule_value}");
                            }
                            break;

                        case 'matches':
                            if($value != $requests[$rule_value]){
                                $this->addError("{$rule_value} не совпадают {$item}");
                            }
                            break;
//                        todo
                        case 'unique':
                            $check = $this->model->select("SELECT * FROM {$rule_value} WHERE {$item} = '{$value}'",[],'one');

                            if($check){
                                $this->addError("{$item} не уникальный");
                            }

                            break;

                    }

                }

            }

        }
        if(empty($this->errors))
        {
            $this->passed = true;
        }
        return $this;
    }

    /**
     * @param $error
     */
    public function addError($error)
    {
        $this->errors[] = $error;
    }

    /**
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function passed(): bool
    {
        return $this->passed;
    }


}