<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ArticlesCheck
{
    
    public function handle(Request $request, Closure $next)
    {
        $password = $request->input('password');
        $correctPassword =123;

        if ($password !== $correctPassword) {
            return response()->json(['message' => 'Unauthorized','pass'=>$password], 401);
        }

        return $next($request);
    }
}
