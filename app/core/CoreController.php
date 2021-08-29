<?php
declare(strict_types=1);

namespace app\core;

use Exception;

abstract class CoreController
{
    /**
     * @var View
     */
    protected View $view;


    protected CoreModel $model;

    public function __construct(protected array $route) {
        $this->view  = new View($route);
        try {
            $this->model = $this->loadModel($route['controller']);
        } catch (Exception $e) {
        }

    }

    /**
     * @param string $nameModel
     * @return CoreModel
     * @throws Exception
     */
    private function loadModel(string $nameModel): CoreModel
    {
        $path = 'app\models\\'.ucfirst($nameModel) . 'Model';

        if (!class_exists($path)) {
            throw new Exception('Модели не существует' . '  ' . $path);
        }
        $db = DB::getInstance()->getPDO();

        return new $path($db);

    }

    /**
     * @return array
     */
    public function getRoute(): array
    {
        return $this->route;
    }

    /**
     * @return View
     */
    public function getView(): View
    {
        return $this->view;
    }

    /**
     * @return CoreModel
     */
    public function getModel(): CoreModel
    {
        return $this->model;
    }
}