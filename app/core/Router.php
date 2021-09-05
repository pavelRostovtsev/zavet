<?php
declare(strict_types=1);

namespace app\core;

use app\core\Request;

final class Router
{
    /**
     * @var array
     */
    private array $routes = [];

    /**
     * @var string
     */
    private string $currentUrl;

    /**
     * @var array
     */
    private array $params = [];

    /**
     * @var Request
     */
    private Request $request;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->request    = new Request();
        $this->currentUrl = $this->request->getCurrentUrl();
        $this->currentUrl = str_starts_with($this->currentUrl, '?') ?
            strstr($this->currentUrl, '?', true) : $this->currentUrl;
        $paths            = require  "../config/routs.php";
        foreach ($paths as $key => $path) {
            $this->preparingUrl($key, $path);
        }
    }

    /**
     * @return bool
     */
    private function preparingRouterParameters(): bool
    {
        foreach ($this->routes as $route => $params) {

            if (preg_match($route, $this->currentUrl, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * @return void
     */
    public function run(): void
    {
       if ($this->preparingRouterParameters() !== false) {
           $path = 'app\http\Controllers\\'.ucfirst($this->params['controller']).'Controller';
           if (class_exists($path)) {
               $action = $this->params['action'];
               if (method_exists($path, $action)) {
                   $this->connectionMiddleware();
                   $controller = new $path($this->params, $this->request);
                   $controller->$action();

               } else {
                    echo 404;
               }
           } else {
               echo 404;
           }
       } else {
           echo 404;
       }
    }

    /**
     * @param $route
     * @param $params
     * @return void
     */
    private function preparingUrl($route, $params): void
    {
        $route                = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
        $route                = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    private function connectionMiddleware()
    {
        if (array_key_exists('middleware',$this->params)) {
            $path = 'app\http\Middleware\\'.ucfirst($this->params['middleware']).'Middleware';

            if (class_exists($path)) {
                $middleware = new $path($this->request);

            }
        }
    }
}