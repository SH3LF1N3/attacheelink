<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * No longer needed — delete this file.
 * /dashboard is handled directly by Dashboard@dash with 'auth' middleware.
 * This file is kept empty to avoid breaking any existing references.
 */
class RoleRedirect
{
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}