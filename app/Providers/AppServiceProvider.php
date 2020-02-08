<?php

namespace App\Providers;

use App\File;
use App\Kelas;
use App\Observers\FileObserver;
use App\Observers\KelasObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Kelas::observe(KelasObserver::class);
        File::observe(FileObserver::class);
    }
}
