<?php

namespace Aqil\MicroApp;

use Aqil\MicroApp\Kernel\ServiceContainer;
use Aqil\MicroApp\Payment\Application;

/**
 * Class Factory.
 *
 * @method static Application payment(array $config)
 * @method static MiniProgram\Application        miniProgram(array $config)
 */
class Factory
{
    /**
     * @param string $name
     * @param array $config
     *
     * @return ServiceContainer
     */
    public static function make(string $name, array $config): ServiceContainer
    {
        $namespace = Kernel\Support\Str::studly($name);
        $application = "\\Aqil\\MicroApp\\{$namespace}\\Application";

        return new $application($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        return self::make($name, ...$arguments);
    }
}
