<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\Auth;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Add URIs to be excluded here
    ];

    public function handle($request, Closure $next)
    {
        if ($request->route()->named('logout')) {
            if (!Auth::check() || Auth::guard()->viaRemember()) {
                // Temporarily disable CSRF protection for this request
                $this->except[] = $request->route()->uri();
            }
        }

        return parent::handle($request, $next);
    }
}

