<?php

namespace App\Http\Middleware;

use App\Models\Permitdb;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirect
{
    /**
     * All roles (admin, student, company) land on /dashboard.
     * The dashboard blade renders role-specific content for each.
     *
     * Only redirects away if the user has no permit row at all.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user   = $request->user();
        $permit = Permitdb::forRole($user->role);

        if (! $permit) {
            return redirect()->route('profile');
        }

        return $next($request);
    }
}