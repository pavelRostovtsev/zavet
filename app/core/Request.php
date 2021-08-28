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

        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->cookie = $_COOKIE;
        $this->file = $_FILES;
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
     * @return array|string
     */
    public function getPostData(string $arrayKey): array|string
    {
        return $this->post[$arrayKey];
    }

    /**
     * @param string $arrayKey
     * @return array|string
     */
    public function getGetData(string $arrayKey): array|string
    {
        return $this->get[$arrayKey];
    }

    /**
     * @param string $arrayKey
     * @return array|string
     */
    public function getServerData(string $arrayKey): array|string
    {
        return $this->server[$arrayKey];
    }

}