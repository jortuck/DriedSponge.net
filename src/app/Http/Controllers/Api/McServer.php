<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\McPlayer;
use App\Models\McStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Validator;
use function Illuminate\Events\queueable;

class McServer extends Controller
{
    public function saveStats(Request $request, $id)
    {
        $server = \App\Models\McServer::find($id);
        if ($server) {
            if ($request->hasHeader("Authorization")) {
                if (Hash::check($request->bearerToken(), $server->password) || \App::isLocal()) {
                    $validator = Validator::make($request->all(), [
                        "uuid" => "required|uuid",
                        "stats" => "required|json",
                        "username"=>"required"
                    ]);
                    if($validator->passes()){
                        $player = McPlayer::where('uuid', $request->uuid)->with([
                            'stats'=>function($query) use ($server) {
                                $query->select("id","user_id","server_id");
                                $query->where("server_id",$server->id);
                            },
                            'servers:id'
                        ])->first();

                        if (!$player) {
                            $player = new McPlayer();
                            $player->uuid= $request->uuid;
                            $player->username = $request->username;
                            $player->save();
                        }
                        return $this->setStats($player,$server,$request->stats);
                    }
                    return response()->json(['error'=>'invaild fields',"errors"=>$validator->errors()],400);
                }
                return response()->json(["error" => "Unauthorized"], 403);

            }
            return response()->json(["error" => "Unauthenticated"], 401);

        }
        return response()->json(["error" => "Not found"], 404);
    }

    /**
     *  Save the players and stats
     * @param $player McPlayer player
     * @param $server \App\Models\McServer server
     * @param $statsJson String statsjson
     */
    public function setStats($player, $server, $statsJson){

        // If the server is not connected to the player, create the relationshop
        if(!$player->servers->where("id",$server->id)->first()){
            $server->players()->save($player);
        }

        // If the player has stats for the server, update them. Otherwise create a new stats entry
        if($player->stats->first()){
            $player->stats->first()->stats = $statsJson;
            $player->stats->first()->save();
            return response()->json(["Data saved"],200);
        }else{
            $stats = new McStat();
            $stats->stats = $statsJson;
            $stats->save();
            $server->stats()->save($stats);
            $player->stats()->save($stats);
            return response()->json(["Data saved"],201);
        }
    }
}

