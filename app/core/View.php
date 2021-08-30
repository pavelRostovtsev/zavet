<?php
declare(strict_types=1);

namespace app\core;

use JetBrains\PhpStorm\NoReturn;

final class View
{
    /**
     * @var string
     */
    private string $path;

    /**
     * @var string
     */
    private string $layout = 'default';

    const PATH_TO_TEMPLATES = '/var/www/html/zavet/app/views/';

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
    #[NoReturn]
    public function render($title, $vars = []): void
    {
        extract($vars);
        $path = self::PATH_TO_TEMPLATES . $this->path.'.php';

        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();

            require self::PATH_TO_TEMPLATES . 'layouts/'.$this->layout.'.php';
        }
    }

    #[NoReturn]
    public static function errorCode($code): void
    {
        http_response_code($code);
        $path = self::PATH_TO_TEMPLATES . 'errors/'.$code.'.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }
}