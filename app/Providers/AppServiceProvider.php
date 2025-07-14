<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrap();

        $config = Config::findOrFail(1);
        View::share('config', $config);
    }
}
