<?php

namespace App\Http\Middleware;

use Closure;
use App\Course;
use Illuminate\Support\Facades\Auth;

class CourseAuthMiddleware
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
        if (!Course::findOrFail($request->course_id)->hasUser(Auth::user()))
            return response()->json(['error' => 'You are not in this course, please enroll before you can access this class'], 403);

        return $next($request);
    }
}
