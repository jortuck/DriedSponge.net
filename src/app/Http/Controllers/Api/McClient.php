<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\McServer;
use Illuminate\Http\Request;
use Spirit55555\Minecraft\MinecraftColors;
use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;
use xPaw\MinecraftQueryException;

class McClient extends Controller
{
    public function index(){
        $mcservers = McServer::select("name","ip","port")->where('private',false)->get();
        $mcservers->transform(function ($item, $key) {
            try {
                $ping = new MinecraftPing( $item->ip, $item->port,3,false);
                $status = $ping->Query();
                $status['description']['text'] = MinecraftColors::convertToHTML($status['description']['text']);
                $item->online = true;
                $item->status =$status;

            }catch (MinecraftPingException $e){
                $item->status = false;
                $item->online = false;
                $item->error =$e->getMessage();
            }
            return $item;
        });

        return response()->json(["success"=>"true","data"=>$mcservers]);
    }
}
