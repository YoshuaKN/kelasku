<?php

namespace App\Http\Middleware;

use Closure;
use App\Course;
use Illuminate\Support\Facades\Auth;

class OwnerAuthMiddleware
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
        if (Course::findOrfail($request->course_id)->owner != Auth::user()->id)
            return response()->json(['error' => 'Only the owner can access this method'], 403);

        return $next($request);
    }
}
