<?php


namespace Aqil\MicroApp\MiniProgram;

use Aqil\MicroApp\MiniProgram\Auth\Client;
use Aqil\MicroApp\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 *
 * @property Client $auth
 */
class Application extends ServiceContainer
{

    protected array $providers = [
        Auth\ServiceProvider::class,
    ];

    /**
     * Handle dynamic calls.
     * @param string $method
     * @param array $args
     *
     * @return mixed
     */
    public function __call(string $method, array $args)
    {
        return $this->base->$method(...$args);
    }
}
