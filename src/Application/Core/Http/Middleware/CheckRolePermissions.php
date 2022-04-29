<?php

namespace App\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckRolePermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $requiredRole = 'ROLE_' . $request->method();
        $userRoles = $request->user()->roles->pluck('name')->toArray();

        if (! in_array($requiredRole, $userRoles)) {
            return response()->json([
                'message' => 'User unauthorized!',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
