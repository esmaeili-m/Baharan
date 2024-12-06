<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$permission): Response
    {
        if (!auth()->user() || !auth()->user()->hasPermission($permission)) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید.');
        }
        return $next($request);
    }
}
