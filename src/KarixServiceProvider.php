<?php
namespace samuelbie\Karix;

use Illuminate\Support\ServiceProvider;

class KarixServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/karix.php' => config_path('karix.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/karix.php',
            'karix'
        );
    }
}
