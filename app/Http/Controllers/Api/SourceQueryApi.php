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
                $query = new SourceQuery();
                try {
                    $query->Connect($request->get('server_ip'), $request->get('server_port'), 3, SourceQuery::SOURCE);
                    $server_info = mb_convert_encoding($query->GetInfo(),'UTF-8', 'UTF-8');
                    $server_players = $query->GetPlayers();
                    return response()->json(['success' => true, 'data' => ['server_info' => $server_info, 'server_players' =>$server_players]]);
                } catch (\Exception $e) {
                    return response()->json(['success' => false, 'errors' => $e->getMessage(), 'message' => 'Could not connect to server']);
                } finally {
                    $query->disconnect();
                }
            }
            return response()->json(['success' => false, 'errors' => $validator->errors(), 'message' => 'Invalid request data']);
        }else{
            return response()->json(['success' => false, 'message' => 'Unauthorized'],403);
        }
    }
    public function Info(Request $request)
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
                $query = new SourceQuery();
                try {
                    $query->Connect($request->get('server_ip'), $request->get('server_port'), 3, SourceQuery::SOURCE);
                    $server_info = mb_convert_encoding($query->GetInfo(),'UTF-8', 'UTF-8');
                    return response()->json(['success' => true, 'data' => ['server_info' => $server_info]]);
                } catch (\Exception $e) {
                    return response()->json(['success' => false, 'errors' => $e->getMessage(), 'message' => 'Could not connect to server']);
                } finally {
                    $query->disconnect();
                }
            }
            return response()->json(['success' => false, 'errors' => $validator->errors(), 'message' => 'Invalid request data']);
        }else{
            return response()->json(['success' => false, 'message' => 'Unauthorized'],403);
        }
    }
}
