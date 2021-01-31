<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\McServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;

class McServerController extends Controller
{
    public function index(Request $request){
        if(!\Auth::guest()){
            if(\Auth::user()->hasPermissionTo('Projects.See')){
                $alerts = McServer::select('id','ip','port','created_at','private','name','description')->orderBy('created_at','desc')->paginate(10);
                return response()->json($alerts);
            }else{
                return response()->json(['error' => 'Unauthorized'])->setStatusCode(403);
            }
        }
        return response()->json(['error' => 'Unauthenticated'])->setStatusCode(401);
    }

    public function store(Request $request)
    {
        if(\Auth::guest()){
            return response()->json(['error' => 'Unauthenticated'],401);
        }
        if (\Auth::user()->hasPermissionTo('Projects.Create')) {
            $validator = Validator::make($request->all(), [
                "name" => "required|max:100",
                "ip" => "required|max:50",
                "port" => "integer",
                "description" => "max:2000",
                "private" => "required|boolean"
            ]);
            if ($validator->passes()) {
                $server = new McServer();
                $server->name = $request->name;
                $server->ip = $request->ip;
                $server->port = $request->port;
                $server->description = $request->description;
                $server->private = $request->private;
                $pass = Str::random(64);
                $server->password = Hash::make($pass);
                $server->save();
                return response()->json(['success' => "The server has been added! The servers api key is <b>$pass</b>! Don't lose it!"],201);
            }
            return response()->json($validator->errors(),400);
        } else {
            return response()->json(['error' => 'Unauthorized'],403);
        }
    }
}
