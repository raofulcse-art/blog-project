<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RejectIfAuthenticatedApi
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (auth('api')->check()) {
        return response()->json([
            'message' => 'Already authenticated'
        ], 403);
        }

        return $next($request);


        return $next($request);
    }
}
