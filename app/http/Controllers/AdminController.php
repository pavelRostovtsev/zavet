<?php
declare(strict_types=1);

namespace app\http\controllers;

use app\core\Auth;
use app\core\CoreController;
use app\core\CSRF;
use app\core\Flash;
use app\core\PasswordHelp;
use app\core\Redirect;
use app\core\Request;
use app\core\Session;
use app\core\Validate;
use app\core\View;
use JetBrains\PhpStorm\NoReturn;


class AdminController extends CoreController
{
    /**
     * @var bool
     */
    private bool $statusAuth;

    /**
     * AdminController constructor.
     * @param array $route
     * @param Request $request
     */
    public function __construct(protected array $route, private Request $request)
    {
        parent::__construct($route);

        $this->statusAuth = Session::exists('user');
    }

    #[NoReturn]
    public function registration()
    {
        if ($this->request->isPost()) {
            if (CSRF::check($this->request->getPostData('csrf'))) {
                $validate = new Validate($this->model);
                $validate->check($this->request->getAllPostsArray());
                if (!$validate->passed()) {
                    $errors = $validate->errors();
                    $errors = implode("<br>", $errors);
                    Flash::flash('errors', "$errors");
                    Redirect::redirect('admin/registration');
                }
                $passwordHash = PasswordHelp::passHash($this->request->getPostData('password'));
                $oldPassword  = $this->request->getPostData('password');
                $this->request->setPostData('password', $passwordHash);
                $this->model->create($this->request->getAllPostsArray());
                $auth = new Auth($this->model);
                $name = $this->request->getPostData('name');
                $auth->login($name, $oldPassword);
                Flash::flash('success', 'You Have Successfully Registered');
                Redirect::redirect('');
            }else {
                View::errorCode(403);
            }
        }

        $vars = [
            'csrf' => CSRF::generate(),
            'statusAuth' => $this->statusAuth,
        ];
        $this->getView()->render('Registration',$vars);
    }


    #[NoReturn]
    public function login()
    {
        if ($this->request->isPost()) {
            if (CSRF::check($this->request->getPostData('csrf'))) {
                $validate = new Validate($this->model);
                $validate->check($this->request->getAllPostsArray());
                if (!$validate->passed()) {
                    $errors = $validate->errors();
                    $errors = implode("<br>", $errors);
                    Flash::flash('errors', "$errors");
                    Redirect::redirect('admin/registration');
                }
                $auth = new Auth($this->model);
                $name = $this->request->getPostData('name');
                $auth->login($name, $this->request->getPostData('password'));
                Flash::flash('success', 'You Have Successfully Logged In');
                Redirect::redirect('');

            } else {
                View::errorCode(403);
            }
        }
        $vars = [
            'csrf' => CSRF::generate(),
            'statusAuth' => $this->statusAuth,
        ];
        $this->getView()->render('Login',$vars);
    }

    #[NoReturn]
    public function logOut()
    {
        $admin = new Auth($this->model);
        $admin->logOut();
        Flash::flash('success', 'You have successfully logged out of the systems');
        Redirect::redirect('');
    }
}