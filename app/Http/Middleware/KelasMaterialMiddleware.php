<?php

namespace App\Http\Middleware;

use App\Kelas;
use App\Material;
use Closure;

class KelasMaterialMiddleware
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
        if (Material::findOrFail($request->material_id)->course_id != Kelas::findOrfail($request->kelas_id)->id)
            return response()->json(['error' => 'Material not found in this course'], 403);
            
        return $next($request);
    }
}
