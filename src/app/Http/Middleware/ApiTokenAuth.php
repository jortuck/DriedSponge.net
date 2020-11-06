<?php

namespace App\Http\Middleware;

use App\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
        if ($request->get('api_token') == ''){
            return response()->json(['success' => false,'message' => 'Unauthenticated'],401);
        } else {
            if (!ApiKey::authed($request->get('api_token'))) {
                return response()->json(['success' => false,'message' => 'Unauthenticated'],401);
            } else {
                return $next($request);
            }
        }
    }
}
