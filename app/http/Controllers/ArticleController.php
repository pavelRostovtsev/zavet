<?php
declare(strict_types=1);

namespace app\http\controllers;

use app\core\CoreController;
use app\core\Request;
use JetBrains\PhpStorm\NoReturn;

class ArticleController extends CoreController
{
    /**
     * ArticleController constructor.
     * @param array $route
     * @param Request $request
     */
    public function __construct(protected array $route, private Request $request)
    {
        parent::__construct($route);
    }

    #[NoReturn]
    public function index()
    {
        $page     = $this->request->getGetData('page');
        $sortBy   = $this->request->getGetData('sortBy', 'title');
        $sort     = $this->request->getGetData('sort', 'DESC');
        $articles =  $this->model->findAll($page, $sortBy, $sort);
        dd($articles);
        $this->getView()->render('All records', $articles);
    }


}