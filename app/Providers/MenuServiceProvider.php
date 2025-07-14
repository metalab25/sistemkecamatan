<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        require_once app_path('Helpers/menuHelper.php');
    }

    public function boot(): void
    {
        //
    }
}
