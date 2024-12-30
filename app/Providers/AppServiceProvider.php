<?php

namespace App\Providers;

use App\Models\Config;
use App\Models\Company;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // Setting Data
        $config = Config::findOrFail(1); // Aktifkan setelah dumping data
        View::share('config', $config); // Aktifkan setelah dumping data

        // Company Data
        $company = Company::findOrFail(1); // Aktifkan setelah dumping data
        View::share('company', $company); // Aktifkan setelah dumping data
    }
}
