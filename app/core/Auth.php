<?php
declare(strict_types=1);

namespace app\core;

use app\core\CoreModel;
use app\core\PasswordHelp;
use app\core\Session;
use app\models\AdminModel;

class Auth
{
    /**
     * Auth constructor.
     * @param AdminModel $model
     */
	public function __construct(private AdminModel $model){}

    /**
     * @param string $name
     * @param string $password
     * @return bool
     */
	public function  login(string $name, string $password): bool
    {
        if($name) {
            $user = $this->model->findByName($name);

            if ($user === null) {
                Flash::flash('errors', 'Invalid Username Or Password');
                Redirect::redirect('');
            }
            $checkPass = PasswordHelp::passCheck($password, $user['password']);

            if ($checkPass !== false) {
                Session::put('user', $user['id']);
                return true;
            } else {
                return false;
            }
        }
    }

    public function logOut()
    {
        Session::delete('user');
    }

}