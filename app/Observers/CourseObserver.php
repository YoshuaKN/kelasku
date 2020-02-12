<?php

namespace App\Observers;

use App\Course;
use Illuminate\Support\Facades\Auth;

class CourseObserver
{
    /**
     * Handle the course "created" event.
     *
     * @param  \App\Course  $course
     * @return void
     */
    public function created(Course $course)
    {
        $user = Auth::user();
        $course->user()->attach($user);
    }

    /**
     * Handle the course "updated" event.
     *
     * @param  \App\Course  $course
     * @return void
     */
    public function updated(Course $course)
    {
        //
    }

    /**
     * Handle the course "deleted" event.
     *
     * @param  \App\Course  $course
     * @return void
     */
    public function deleted(Course $course)
    {
        $course->user()->detach();
        $course->attendance()->get()->each(function ($child) {
            $child->delete();
        });
    }

    /**
     * Handle the course "restored" event.
     *
     * @param  \App\Course  $course
     * @return void
     */
    public function restored(Course $course)
    {
        //
    }

    /**
     * Handle the course "force deleted" event.
     *
     * @param  \App\Course  $course
     * @return void
     */
    public function forceDeleted(Course $course)
    {
        //
    }
}
