<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            abort(403, 'Unauthorized');
        }

        $user = $request->user();

        // Normalize roles to lowercase for case-insensitive comparison
        $requiredRoles = array_map('strtolower', $roles);

        // Check if user has any of the required roles (case-insensitive)
        $hasRole = $user->roles()->get()->contains(function ($role) use ($requiredRoles) {
            return in_array(strtolower(trim($role->name)), $requiredRoles);
        });

        if (!$hasRole) {
            abort(403, 'Insufficient permissions');
        }

        return $next($request);
    }
}
