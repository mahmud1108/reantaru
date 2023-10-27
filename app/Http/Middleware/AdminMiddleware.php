<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // dd($user);
        if (
            auth()->check() &&
            in_array($user->role, ['admin', 'super admin']) &&
            $user->status === 'aktif'
        ) {
            toast('Berhasil login sebagai ' . auth()->user()->role, 'success');
            return $next($request);
        }

        toast('Silahkan login terlebih dahulu', 'error');
        return redirect()->route('login-admin');
    }
}
