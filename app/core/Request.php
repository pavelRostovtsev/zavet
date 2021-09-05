<?php
declare(strict_types=1);

namespace app\core;

class Request
{
    /**
     * @var array
     */
    private array $get;

    /**
     * @var array
     */
    private array $post;

    /**
     * @var array
     */
    private array $server;

    /**
     * @var array
     */
    private array $cookie;

    /**
     * @var array
     */
    private array $file;

    /**
     * @var array
     */
    private array $session;

    /**
     * Request constructor.
     */
    public function __construct()
    {

        $this->get     = $_GET;
        $this->post    = $_POST;
        $this->server  = $_SERVER;
        $this->cookie  = $_COOKIE;
        $this->file    = $_FILES;
        $this->session = $_SESSION;
    }

    /**
     * @return array
     */
    public function getAllPostsArray(): array
    {
        return $this->post;
    }

    /**
     * @return array
     */
    public function getAllGetsArray(): array
    {
        return $this->post;
    }

    /**
     * @return array
     */
    public function getAllServerArray(): array
    {
        return $this->server;
    }

    /**
     * @param string $arrayKey
     * @param null $default
     * @return array|string|null
     */
    public function getPostData(string $arrayKey, $default = null): array|string|null
    {
        return isset($this->post[$arrayKey]) ? $this->post[$arrayKey] : $default;

    }

    /**
     * @param string $arrayKey
     * @param null $default
     * @return string|null
     */
    public function getGetData(string $arrayKey, $default = null): string|null
    {
        return isset($this->get[$arrayKey]) ? $this->get[$arrayKey] : $default;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return isset($this->get['page']) ? $this->get['page'] : 1;
    }

    /**
     * @param string $arrayKey
     * @return string|null
     */
    public function getServerData(string $arrayKey): string|null
    {
        return isset($this->server[$arrayKey]) ? $this->server[$arrayKey] : null;
    }

    /**
     * @return string
     */
    public function getCurrentUrl(): string
    {
        $currentUrl = $this->getServerData('REQUEST_URI');
        $currentUrl = trim($currentUrl, '/');
        return $currentUrl;
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->post ? true : false;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function setPostData(string $name, string $value): void
    {
        $this->post[$name] = $value;
    }

    /**
     * @param $fileName
     * @return array
     */
    public function getFileData($fileName): array
    {
        return $this->file[$fileName];
    }

    /**
     * @return array
     */
    public function isFIle(): array
    {
        return $this->file;
    }

}