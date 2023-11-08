<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ArticlesCheck
{
    
    public function handle(Request $request, Closure $next)
    {
        if (!auth('sanctum')->check()) {
            return response()->json(['message' => 'You Are Unauthorized'], 401);
        }
    
        return $next($request);
    }
}
