<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$levels
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        if (!in_array($user->level->level, $levels)) {
            return redirect('unauthorized'); 
        }

        return $next($request);
    }
}
