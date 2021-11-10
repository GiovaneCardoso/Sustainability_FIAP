<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Firebase\JWT\ExpiredException;

class ValidateJwt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('authorization');
        $key = config('services.jwt.key');

        try {
            if (!$header) {
                throw new Exception('Unauthenticated.',);
            }

            $token = str_ireplace('Bearer ', '', $header);
            JWT::decode($token, $key, ['HS256']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
        
        return $next($request);
    }
}
