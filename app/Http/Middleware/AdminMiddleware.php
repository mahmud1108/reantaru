<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if (
            auth()->check() &&
            in_array($user->role, ['admin', 'super admin']) &&
            $user->user_status === 'aktif'
        ) {
            return $next($request);
        }

        return redirect()->route('login-admin');
    }
}
