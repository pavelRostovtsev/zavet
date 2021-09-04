<?php

namespace app\core;

use app\core\CoreModel;

class Validate
{
    private bool $passed = false;
    private array $errors = [];

    public function __construct(private CoreModel $model)
    {
        $this->model = $model;
    }

    public function check($method, $items = []) {

        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {

                $value = $method[$item];

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
                            if($value != $method[$rule_value]){
                                $this->addError("{$rule_value} не совпадают {$item}");
                            }
                            break;

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

    public function addError($error)
    {
        $this->errors[] = $error;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function passed()
    {
        return $this->passed;
    }


}