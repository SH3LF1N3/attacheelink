<?php

namespace App\Http\Middleware;

use App\Models\Permitdb;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * This middleware ONLY checks a permission flag.
     * Authentication is enforced separately by the 'auth' middleware.
     * Always stack as: ['auth', 'permission:FLAG']
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $permit = Permitdb::forRole($request->user()->role);

        if (! $permit || ! $permit->can($permission)) {
            abort(403, 'You do not have permission to access this area.');
        }

        return $next($request);
    }
}