<?php
declare(strict_types=1);

namespace app\core;

use JetBrains\PhpStorm\NoReturn;

final class View
{
    private $path;
    private $layout = 'default';

    /**
     * View constructor.
     * @param array $route
     */
    public function __construct(private array $route)
    {
        $this->path = $route['controller'].'/'.$route['action'];
    }

    /**
     * @param $title
     * @param array $vars
     */
    public function render($title, $vars = [])
    {
        extract($vars);
        $path = 'app/views/'.$this->path.'.php';
        var_dump($path);die;
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'app/views/layouts/'.$this->layout.'.php';
        }
    }

    #[NoReturn]
    public static function errorCode($code)
    {
        http_response_code($code);
        $path = 'app/views/errors/'.$code.'.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }
}