<?php

namespace Astrotomic\Weserv\Images\Laravel;

use Illuminate\Support\ServiceProvider;

class WeservImagesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('weserv-images.php'),
            ], 'config');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'weserv-images');

        $this->app->singleton(Factory::class);
    }
}
