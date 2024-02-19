<?php

namespace App\Providers;

use App\Models\Tanggapan;
use App\Observers\TanggapanObserver;
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
        Tanggapan::observe(TanggapanObserver::class);
    }
}
