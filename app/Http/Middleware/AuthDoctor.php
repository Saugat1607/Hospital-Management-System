<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthDoctor
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (!Auth::guard('doctor')->check()) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}