<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSessionCookie
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasSession()) {
            return redirect('http://127.0.0.1:8000/login');
        }

        return $next($request);
    }
}
