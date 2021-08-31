<?php
declare(strict_types=1);

namespace app\core\Patterns\Singleton;

abstract class Singleton
{
    /**
     * @var array
     */
    private static array $instances = [];

    /**
     * Singleton constructor is closed
     */
    protected function __construct(){}

    /**
     * Singleton clone method is closed
     */
    protected function __clone(){}

    /**
     * Singleton wakeup method is closed
     */
    public function __wakeup(){}

    /**
     * @return static
     */
    public static function getInstance(): static
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])){
            self::$instances[$subclass] = new static();
        }
        return static::$instances[$subclass];
    }
}