<?php


namespace Aqil\MicroApp;

use Aqil\MicroApp\Payment\Application as Payment;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;


class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Boot the provider.
     */
    public function boot()
    {
    }

    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/config.php');

        $this->publishes([$source => config_path('micro-app.php')], 'micro-app');

        $this->mergeConfigFrom($source, 'micro-app');
    }

    /**
     * Register the provider.
     */
    public function register()
    {
        $this->setupConfig();

        $apps = [
            'payment' => Payment::class,
        ];

        foreach ($apps as $name => $class) {
            if (empty(config('micro-app.' . $name))) {
                continue;
            }


            if (!empty(config('micro-app.' . $name . '.app_id'))) {
                $accounts = [
                    'default' => config('micro-app.' . $name),
                ];
                config(['micro-app.' . $name . '.default' => $accounts['default']]);
            } else {
                $accounts = config('micro-app.' . $name);
            }

            foreach ($accounts as $account => $config) {
                $this->app->singleton("micro-app.{$name}.{$account}", function ($laravelApp) use ($name, $account, $config, $class) {
                    $app = new $class(array_merge(config('micro-app.defaults', []), $config));
                    if (config('micro-app.defaults.use_laravel_cache')) {
                        $app['cache'] = $laravelApp['cache.store'];
                    }
                    $app['request'] = $laravelApp['request'];

                    return $app;
                });
            }
            $this->app->alias("micro-app.{$name}.default", 'micro-app.' . $name);

            $this->app->alias('micro-app.' . $name, $class);
        }
    }

}
