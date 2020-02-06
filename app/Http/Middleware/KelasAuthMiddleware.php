<?php

namespace App\Http\Middleware;

use Closure;
use App\Kelas;
use Illuminate\Support\Facades\Auth;

class KelasAuthMiddleware
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
        if (!Kelas::findOrFail($request->kelas_id)->hasUser(Auth::user()))
            return response()->json(['error' => 'You are not in this class, please register before you can access this class'], 403);

        return $next($request);
    }
}
