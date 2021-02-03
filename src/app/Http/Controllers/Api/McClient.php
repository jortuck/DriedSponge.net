<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\McPlayer;
use App\Models\McServer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spirit55555\Minecraft\MinecraftColors;
use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;
use xPaw\MinecraftQueryException;

class McClient extends Controller
{
    public function getServers()
    {
        $mcservers = McServer::select("name", "ip", "port", "slug")->where('private', false)->get();
        $mcservers->transform(function ($item, $key) {
            try {
                $ping = new MinecraftPing($item->ip, $item->port, 2, false);
                $status = $ping->Query();
                $status['description']['text'] = MinecraftColors::convertToHTML($status['description']['text']);
                $item->online = true;
                $item->status = $status;

            } catch (MinecraftPingException $e) {
                $item->status = false;
                $item->online = false;
                $item->error = $e->getMessage();
            }
            return $item;
        });
        return response()->json(["success" => "true", "data" => $mcservers]);

    }

    public function getServer(Request $request, $slug)
    {
        $mcserver = McServer::select("name",'id', "ip", "port", "description")->where('private', false)->where('slug', $slug)->with('players')->first();
        if (!$mcserver) {
            return response()->json(["error" => "Not found"], 404);
        }

        $mcplayers = $mcserver->players;
        $mcresponse = collect();
        $mcresponse->put('ip',$mcserver->ip);
        $mcresponse->put('port',$mcserver->port);
        $mcresponse->put('description',$mcserver->description);
        $mcresponse->put('name',$mcserver->name);

        try {
            $ping = new MinecraftPing($mcserver->ip, $mcserver->port, 2, false);
            $status = $ping->Query();
            $mcresponse->put("online",true);
            $mcresponse->put("mc_version",Arr::get($status,"version.name"));
            $mcresponse->put("message",MinecraftColors::convertToHTML(Arr::get($status,"description.text")));

            if(Arr::has($status,"players.sample")) { // Check if we have online players
                foreach ($status['players']['sample'] as $ply) { // Loop through players connected to server, add them to the db and relate them to the server
                    $player = $mcplayers->where('uuid', $ply['id'])->first(); //
                    if (!$player) {
                        $player = McPlayer::where('uuid', $ply['id'])->first();
                        if (!$player) {
                            $newplayer = new McPlayer();
                            $newplayer->uuid = $ply['id'];
                            $newplayer->username = $ply['name'];
                            $newplayer->save();
                            $newplayer->servers()->save($mcserver);
                        } else {
                            $player->servers()->save($mcserver);
                        }
                    }
                }
                $onlineplayers = collect($status['players']['sample']);
                $mcplayers = $mcserver->players()->get();
                foreach ($mcplayers as $player){
                     if($onlineplayers->where('name', $player->username)){
                         $player->online = true;
                     }else{
                         $player->online = false;
                     }
                }

            }
            //$mcresponse->put("players",$mcplayers);
            $mcresponse->put("playerCount",["online"=>Arr::get($status,"players.online",0),"total"=>Arr::get($status,"players.max",0)]);
            $mcresponse->put("mods",Arr::get($status,"modinfo.modList"));
        } catch (MinecraftPingException $e) {
            $mcresponse->put("online",false);
            $mcresponse->put("error",$e->getMessage());
        }

        foreach ($mcplayers as $player){
            if(!$player->online){
                $player->online = false;
            }
        }

        $mcresponse->put("players",$mcplayers);
        return response()->json(["success" => "true", "data" => $mcresponse->toArray()]);
    }

    public function getPlayers()
    {
        $players = McPlayer::select("uuid",'username','id')->with(['servers:id,name,slug'])->get();
        return response()->json(["success" => "true", "data" => $players]);
    }

    public function getPlayer(Request $request, $username)
    {
        $player = McPlayer::select("uuid",'username','id')->where('username',$username)->with('servers:id,name,slug')->first();
        if(!$player){
            return response()->json(["error"=>"Not found"],404);
        }
        $player->stats = $player->stats()->with('server:id,name')->get();
        return response()->json(["success" => "true", "data" => $player]);
    }

}
