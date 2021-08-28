<?php
declare(strict_types=1);

namespace app\core;

class Router {
    /**
     * @var array
     */
    private array $allRouts = [];

    /**
     * @var string
     */
    private string $currentUrl;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $allRouts = require  "../config/routs.php";
    }

    /**
     * @param string $currentUrl
     */
    public function setCurrentUrl(string $currentUrl): void
    {
        var_dump();
        $this->currentUrl = $currentUrl;
    }


}