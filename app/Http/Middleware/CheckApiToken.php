<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        if (empty($token)) {
            return response()->json([
                'message' => 'Unauthorized',
                'errors' => [
                    'auth' => 'Unauthorized',
                ],
            ], 401);
        }
        if (strpos($token, 'Bearer ') === 0) {

            $token = substr($token, 7);

        }
        $user = \App\Models\User::where('token', $token)->first();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $request->user = $user;

        return $next($request);
    }
}
