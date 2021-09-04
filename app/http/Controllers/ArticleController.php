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
        $vars     = [
            'articles' => $articles
        ];
        $this->getView()->render('All records', $vars);
    }

    #[NoReturn]
    public function show()
    {
        if (!$this->model->isRecordExists($this->route['id'])) {
            $this->getView()->errorCode(404);
        }
        $vars = [
            'article' => $this->model->findId($this->route['id'])[0],
        ];
        $this->getView()->render($vars['article']['title'], $vars);
    }
    #[NoReturn]
    public function create()
    {
        $this->getView()->render('Create Article');
    }

    #[NoReturn]
    public function store()
    {
        $articleData = $this->request->getAllPostsArray();
        $this->model->create($articleData);
    }

    #[NoReturn]
    public function edit()
    {
        if (!$this->model->isRecordExists($this->route['id'])) {
            $this->getView()->errorCode(404);
        }
        $vars = [
            'article' => $this->model->findId($this->route['id'])[0],
        ];

        $this->getView()->render("Edit  ". $vars['article']['title'], $vars);
    }

    #[NoReturn]
    public function update()
    {
        $this->model->update($this->route['id']);
    }

    #[NoReturn]
    public function destroy()
    {
        if (!$this->model->isRecordExists($this->route['id'])) {
            $this->getView()->errorCode(404);
        }
        $this->model->delete($this->route['id']);
    }

}