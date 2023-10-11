<?php

namespace Soap\DompdfThai;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class DompdfThaiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/dompdf-thai.php' => config_path('dompdf-thai.php'),
            ], 'dompdf-thai-config');

            // Publishing assets.
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/dompdf-thai'),
            ], 'dompdf-thai-assets');

        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/dompdf-thai.php', 'dompdf-thai');

        // Register the main class to use with the facade
        $this->app->singleton('dompdf-thai', function () {
            return new DompdfThai;
        });

        Blade::directive('DompdfThaiFont', function () {
            return <<<EOT
<style>
@font-face {
    font-family: 'THSarabunNew';
    font-style: normal;
    font-weight: normal;
    src: url("{{ public_path('vendor/dompdf-thai/fonts/THSarabunNew.ttf') }}") format('truetype');
}
@font-face {
    font-family: 'THSarabunNew';
    font-style: normal;
    font-weight: bold;
    src: url("{{ public_path('vendor/dompdf-thai/fonts/THSarabunNew Bold.ttf') }}") format('truetype');
}
@font-face {
    font-family: 'THSarabunNew';
    font-style: italic;
    font-weight: normal;
    src: url("{{ public_path('vendor/dompdf-thai/fonts/THSarabunNew Italic.ttf') }}") format('truetype');
}
@font-face {
    font-family: 'THSarabunNew';
    font-style: italic;
    font-weight: bold;
    src: url("{{ public_path('vendor/dompdf-thai/fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
}
</style>
EOT;
        });
    }
}
