<?php

namespace App\Providers;

use App\File;
use App\Course;
use App\Material;
use App\Observers\FileObserver;
use App\Observers\CourseObserver;
use App\Observers\MaterialObserver;
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
        Material::observe(MaterialObserver::class);
        Course::observe(CourseObserver::class);
        File::observe(FileObserver::class);
    }
}
