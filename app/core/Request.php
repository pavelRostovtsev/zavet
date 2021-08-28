<?php
declare(strict_types=1);


namespace app\core;


class Request
{
    const  METHOD_POST = 'POST';
    const METHOD_GET = 'GET';

    private $get;
    private $post;
    private $server;
    private $cookie;
    private $file;
    private $session;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->cookie = $_COOKIE;
        $this->file = $_FILES;
        $this->session = $_SESSION;
    }

}