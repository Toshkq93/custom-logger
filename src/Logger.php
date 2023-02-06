<?php

namespace Logger;

use Logger\Drivers\Driver;
use Psr\Log\AbstractLogger;
use SplObjectStorage;

class Logger extends AbstractLogger
{
    /** @var SplObjectStorage $drivers */
    public $drivers;

    public function __construct()
    {
        $this->drivers = new SplObjectStorage();
    }

    /**
     * @param string $namespace
     * @param array $config
     * @return false|mixed
     */
    public static function factory(string $namespace, array $config = []): AbstractLogger|false
    {
        if (!class_exists($namespace)) {
            return false;
        }

        return new $namespace($config);
    }

    /**
     * @param $level
     * @param $message
     * @param array $context
     * @return void
     */
    public function log($level, $message, array $context = []): void
    {
        foreach ($this->drivers as $route) {
            if (!$route instanceof Driver) {
                continue;
            }

            $route->log($level, $message, $context);
        }
    }
}