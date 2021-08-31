<?php
declare(strict_types=1);

namespace app\http\controllers;

use app\core\CoreController;
use JetBrains\PhpStorm\NoReturn;

class ArticleController extends CoreController
{
    public function __construct(protected array $route)
    {
        parent::__construct($route);
    }

    #[NoReturn]
    public function index()
    {
        $vars = ['test'];
        $this->getView()->render('Главная страница', $vars);
    }
}