<?php

namespace App\Http\Middleware;

use App\Traits\JsonResponder;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
{

    use JsonResponder;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
           $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return $this->unauthenticated();
        }

        return $next($request);
    }
}
