<?php

namespace App\Http\Middleware;

use App\ApiKey;
use Closure;
use Illuminate\Http\Request;

class ApiTokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->get('api_token') == '' and $request->header('HTTP_X_HUB_SIGNATURE') == '' ) {
            return response()->json(['error' => 'Invalid Token']);
        } else {
            $keys = $users = ApiKey::all()->where('api_token', $request->get('api_token'))->count();
            if ($keys != 1) {
                return response()->json(['error' => 'Invalid Token'],403);
            } else {
                return $next($request);
            }
        }
    }
}
