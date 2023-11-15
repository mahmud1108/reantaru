<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::cutomer()->isCustomer()) {
            return $next($request);
        }

        session()->flash('text', 'Mohon login terlebih dahulu');
        session()->flash('type', 'danger');
        return redirect()->route('login_register_customer');
    }
}
