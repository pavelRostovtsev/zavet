<?php
declare(strict_types=1);

namespace app\http\Middleware;

use app\core\CoreMiddleware;
use app\core\Flash;
use app\core\Redirect;
use app\core\Session;

class AdminMiddleware extends CoreMiddleware
{


    public function handle()
    {
        if (Session::exists('user')) {
            Flash::flash('success', 'You Have Successfully Registered');
            Redirect::redirect('');
        }
    }
}