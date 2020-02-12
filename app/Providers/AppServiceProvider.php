<?php

namespace App\Providers;

use App\File;
use App\Course;
use App\Observers\FileObserver;
use App\Observers\CourseObserver;
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
        Course::observe(CourseObserver::class);
        File::observe(FileObserver::class);
    }
}
