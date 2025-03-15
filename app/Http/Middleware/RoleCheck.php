<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Retrieve the role from the session
        $loginRole = $request->session()->get('loginRole');
    
        // Check if the user's role is in the allowed roles
        if (!in_array($loginRole, $roles)) {
            return redirect('/unauthorized'); // Redirect if the role is not allowed
        }
    
        return $next($request);
    }
}
