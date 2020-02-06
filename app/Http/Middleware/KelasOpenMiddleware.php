<?php

namespace App\Http\Middleware;

use App\Kelas;
use Closure;

class KelasOpenMiddleware
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
        if (!Kelas::findOrFail($request->kelas_id)->isOpen()) {
            return response()->json(['error' => "Kelas hasn't opened yet"], 403);
        }
        return $next($request);
    }
}
