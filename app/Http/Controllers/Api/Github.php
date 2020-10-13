<?php

namespace App\Http\Controllers\Api;

use App\ApiKey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Github extends Controller
{
    function Webhook(Request $request){
        $apikey = $request->header('HTTP_X_HUB_SIGNATURE');
        if($apikey!=''){
            if (ApiKey::authed($request->get('api_token'))) {
                $key = ApiKey::where('api_token', $request->get('api_token'))->first();
                if ($key->hasPermissionTo('GitHubWebhook', 'api')) {
                    return response()->json(['success' => false,'message' => 'adadadad'],200);
                }else{
                    return response()->json(['success' => false,'message' => 'Authenticated'],403);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Unauthorized'],403);
            }
        }
        return response()->json(['success' => false,'message' => 'Unauthenticated'],401);
    }
}
