<?php

namespace App\Http\Middleware;

use App\File;
use Closure;

class FileSubmitMiddleware
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
        if (File::find($request->file_id)->shareable) 
            return response()->json(['error' => 'This file is shareable'], 403);

        return $next($request);
    }
}
