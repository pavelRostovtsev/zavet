<?php
declare(strict_types=1);

namespace app\http\controllers;

use app\core\CoreController;
use app\core\Request;
use JetBrains\PhpStorm\NoReturn;

class AdminController extends CoreController
{
    public function __construct(protected array $route, private Request $request)
    {
        parent::__construct($route);
    }

    #[NoReturn] public function registration()
    {
        $this->getView()->render('Registration');
    }


    #[NoReturn] public function login()
    {
        $this->getView()->render('Login');
    }

    public function logOut()
    {

    }
}