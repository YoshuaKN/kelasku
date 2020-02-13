<?php

namespace App\Http\Middleware;

use App\File;
use Closure;
use Illuminate\Support\Facades\Auth;

class FileOwnerOrTeacherMiddleware
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
        $user = Auth::user();
        if (File::findOrFail($request->file_id)->owner != $user->id && $user->user_type != 'T') 
            return response()->json(['error' => File::findOrFail($request->file_id)->owner], 403);

        return $next($request);
    }
}
