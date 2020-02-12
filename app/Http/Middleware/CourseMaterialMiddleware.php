<?php

namespace App\Http\Middleware;

use App\Course;
use App\Material;
use Closure;

class CourseMaterialMiddleware
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
        if (Material::findOrFail($request->material_id)->course_id != Course::findOrfail($request->course_id)->id)
            return response()->json(['error' => 'Material not found in this course'], 403);
            
        return $next($request);
    }
}
