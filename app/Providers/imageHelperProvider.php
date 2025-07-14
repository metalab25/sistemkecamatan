<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class imageHelperProvider extends ServiceProvider
{
    public function register(): void
    {
        require_once app_path('Helpers/imageHelper.php');
    }

    public function boot(): void
    {
        //
    }
}
