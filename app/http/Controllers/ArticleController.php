<?php
declare(strict_types=1);

namespace app\http\controllers;

use app\core\CoreController;
use app\core\CSRF;
use app\core\FileDriver;
use app\core\Flash;
use app\core\Redirect;
use app\core\Request;
use app\core\Session;
use app\core\Validate;
use app\core\View;
use JetBrains\PhpStorm\NoReturn;

class ArticleController extends CoreController
{
    private bool $statusAuth;

    /**
     * ArticleController constructor.
     * @param array $route
     * @param Request $request
     */
    public function __construct(protected array $route, private Request $request)
    {
        parent::__construct($route);

        $this->statusAuth = Session::exists('user');
    }

    #[NoReturn]
    public function index()
    {
        $page     = $this->request->getGetData('page');
        $sortBy   = $this->request->getGetData('sortBy', 'title');
        $sort     = $this->request->getGetData('sort', 'DESC');
        $articles =  $this->model->findAll($page, $sortBy, $sort);
        $vars     = [
            'articles'  => $articles,
            'statusAuth' => $this->statusAuth,
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
            'statusAuth' => $this->statusAuth,
        ];
        $this->getView()->render($vars['article']['title'], $vars);
    }
    #[NoReturn]
    public function create()
    {
        $vars = [
            'csrf' => CSRF::generate(),
            'statusAuth' => $this->statusAuth,
        ];

        $this->getView()->render('Create Article', $vars);
    }

    #[NoReturn]
    public function store()
    {
        if (CSRF::check($this->request->getPostData('csrf'))) {
            $validate = new Validate($this->model);
            $validate->check($this->request->getAllPostsArray());
            if (!$validate->passed()) {
                $errors = $validate->errors();
                $errors = implode("<br>",$errors);
                Flash::flash('errors', "$errors");

                Redirect::redirect('articles/create');
            }
            $articleData = $this->request->getAllPostsArray();
            $fileDriver = new FileDriver($this->request->getFileData());
            $this->model->create($articleData);
            Flash::flash('success', 'The Post Created');
            Redirect::redirect('');
        } else {
            View::errorCode(403);
        }
    }

    #[NoReturn]
    public function edit()
    {
        if (!$this->model->isRecordExists($this->route['id'])) {
            $this->getView()->errorCode(404);
        }
        $vars = [
            'article' => $this->model->findId($this->route['id'])[0],
            'csrf' => CSRF::generate(),
            'statusAuth' => $this->statusAuth,
        ];

        $this->getView()->render("Edit  ". $vars['article']['title'], $vars);
    }

    #[NoReturn]
    public function update()
    {
        if (CSRF::check($this->request->getPostData('csrf'))) {
            if (!$this->model->isRecordExists($this->route['id'])) {
                $this->getView()->errorCode(404);
            }
            $validate = new Validate($this->model);
            $validate->check($this->request->getAllPostsArray());
            if (!$validate->passed()) {
                $errors = $validate->errors();
                $errors = implode("<br>",$errors);
                Flash::flash('errors', "$errors");
                $id = $this->request->getPostData('id');
                Redirect::redirect("article/edit/$id");
            }
            $this->model->update($this->route['id']);
            Flash::flash('success', 'The Post Updated');
            Redirect::redirect('');
        } else {
            View::errorCode(403);
        }

    }

    #[NoReturn]
    public function destroy()
    {
        if (!$this->model->isRecordExists($this->route['id'])) {
            $this->getView()->errorCode(404);
        }
        $this->model->delete($this->route['id']);
        Flash::flash('success', 'The Post Deleted');
        Redirect::redirect('');
    }

}