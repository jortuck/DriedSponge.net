<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use xPaw\SourceQuery\SourceQuery;
class SourceQueryApi extends Controller
{
    public function GetAll(Request $request){
        $validator =  Validator::make($request->all(), [
            "server_ip" => "required",
            "server_port" => "required",
        ]);
        if ($validator->passes()) {
            $server_ip = $request->get('server_ip');
            $Query = new SourceQuery();
            try{
                $Query->Connect( '208.1032424.169.42','27015', 300, SourceQuery::SOURCE);
                return response()->json(['success' =>  $Query->GetInfo( )]);

            }catch(\Exception $e)
            {
                return response()->json(['errors'=>'Could not connect to server']);

            }
        }
        return response()->json(['errors'=>$validator->errors()]);
    }
}
