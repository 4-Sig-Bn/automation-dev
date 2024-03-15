<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Assuming you have a 'role' column in your users table
        if ($request->user() && $request->user()->roles()->first()->name === 'admin') {
            return $next($request);
        }

        // User is not an admin, redirect or return a forbidden response
        // return redirect('/');
        //return response()->json(['error' => 'Access denied. Admin privileges required.'], 403);

    }
}
