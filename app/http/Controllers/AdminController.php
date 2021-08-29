<?php
declare(strict_types=1);

namespace app\http\controllers;

use app\core\CoreController;

class AdminController extends CoreController
{
    public function index()
    {
        echo 'привет ебать';
    }
}