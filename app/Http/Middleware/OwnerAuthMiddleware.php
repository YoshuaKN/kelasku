<?php

namespace App\Http\Middleware;

use Closure;
use App\Kelas;
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
        if (Kelas::findOrfail($request->kelas_id)->owner != Auth::user()->id)
            return response()->json(['error' => 'Only the owner can access this method'], 403);

        return $next($request);
    }
}
