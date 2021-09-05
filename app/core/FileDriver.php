<?php
declare(strict_types=1);

namespace app\core;

class FileDriver
{
    public function __construct(private array $file)
    {
        dd($file);
    }
}