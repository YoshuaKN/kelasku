<?php

namespace App\Http\Middleware;

use App\Course;
use Closure;

class CourseOpenMiddleware
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
        if (!Course::findOrFail($request->course_id)->isOpen()) {
            return response()->json(['error' => "Course hasn't opened yet"], 403);
        }
        return $next($request);
    }
}
