<?php


namespace Aqil\MicroApp\MiniProgram\Auth;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        !isset($app['auth']) && $app['auth'] = function ($app) {
            return new Client($app);
        };
    }
}
