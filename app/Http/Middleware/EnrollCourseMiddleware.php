<?php

namespace App\Http\Middleware;

use Closure;
use App\Kelas;
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
        if (Auth::user()->user_type != 'S') {
            return response()->json(['error' => 'Only student can access this method'], 403);
        }
        if (Kelas::findOrfail($request->kelas_id)->hasUser(Auth::user())) {
            return response()->json(['error' => 'Already enroll this course'], $this->successStatus);
        }

        return $next($request);
    }
}
