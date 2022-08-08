<?php

namespace App\Http\Middleware;

use App\Constants;
use Closure;
use Illuminate\Http\Request;

class AdminsAbilitiesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role = null)
    {

        if ($role) {
            if (!in_array(auth('sanctum')->user()->role_id, [$role, Constants::MANAGER])) {
                abort(403);
            }
        } else {
            if (!in_array(auth('sanctum')->user()->role_id, [Constants::WAREHOUSE_GUARD, Constants::MANAGER, Constants::ACCOUNTANT])) {
                abort(403);
            }
        }
        return $next($request);
    }
}
