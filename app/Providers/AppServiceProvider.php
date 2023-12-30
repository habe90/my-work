<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ContentPage;
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
        view()->share('contentPages', ContentPage::where('active', 1)->get());
    }
}
