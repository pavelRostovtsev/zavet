<?php
declare(strict_types=1);


namespace app\core;


abstract class CoreMiddleware
{
    public function __construct(protected Request $request)
    {
        $this->handle();
    }

    public abstract function handle();
}