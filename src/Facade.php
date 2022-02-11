<?php


namespace Aqil\MicroApp;

use Illuminate\Support\Facades\Facade as LaravelFacade;


class Facade extends LaravelFacade
{
    /**
     * 默认为 Server.
     *
     * @return string
     */
    public static function getFacadeAccessor(): string
    {
        return 'micro-app';
    }


    /**
     * @param string $name
     * @return Payment\Application
     */
    public static function payment(string $name = ''): Payment\Application
    {
        return $name ? app('micro-app.payment.' . $name) : app('micro-app.payment');
    }
}
