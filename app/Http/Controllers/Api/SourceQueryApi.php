<?php

namespace App\Http\Controllers\Api;

use App\ApiKey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use xPaw\SourceQuery\SourceQuery;
use Spatie\Permission\Models\Permission;

class SourceQueryApi extends Controller
{
    public function GetAll(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "server_ip" => "required",
            "server_port" => "required",
        ]);
        $keys = ApiKey::where('api_token', $request->get('api_token'))->first();
        $key = ApiKey::find($keys->id);
        $key->UpdateUsage();
        if ($key->hasPermissionTo('SourceQuery', 'api')) {
            if ($validator->passes()) {
                $server_ip = $request->get('server_ip');
                $Query = new SourceQuery();
                try {
                    $Query->Connect($request->get('server_ip'), $request->get('server_port'), 30, SourceQuery::SOURCE);
                    return response()->json(['success' => true, 'data' => ['server_info' => $Query->GetInfo(), 'server_players' => $Query->GetPlayers()]]);
                } catch (\Exception $e) {
                    return response()->json(['success' => false, 'errors' => 'Could not connect to server', 'message' => 'Could not connect to server']);

                }
            }
            return response()->json(['success' => false, 'errors' => $validator->errors(), 'message' => 'Invalid request data']);
        }else{
            return response()->json(['success' => false, 'message' => 'Unauthorized'],403);
        }
    }

}
