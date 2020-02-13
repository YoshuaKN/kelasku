<?php

namespace App\Http\Middleware;

use Closure;
use App\Course;
use Illuminate\Support\Facades\Auth;

class EnrollCourseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Course::findOrfail($request->course_id)->hasUser(Auth::user())) {
            return response()->json(['error' => 'Already enroll this course'], 403);
        }
        return $next($request);
    }
}
