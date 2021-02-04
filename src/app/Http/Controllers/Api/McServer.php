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
                if (Hash::check($request->bearerToken(), $server->password)) {
                    $validator = Validator::make($request->all(), [
                        "uuid" => "required|uuid",
                        "stats" => "required|json",
                        "username"=>"required"
                    ]);
                    if($validator->passes()){
                        $player = McPlayer::where('uuid', $request->uuid)->first();
                        if (!$player) {
                            $newPlayer = Http::get("https://api.mojang.com/users/profiles/minecraft/".$request->username);
                            if($newPlayer->successful()){
                                $player = new McPlayer();
                                $player->uuid= $request->uuid;
                                $player->username = $request->username;
                                $player->save();
                                $server->players()->save($player);
                            }else{
                                return response()->json(['error'=>'Invalid Player'],400);
                            }
                        }
                        $stats = $player->stats()->where("server_id",$server->id)->first();
                        if($stats){
                            $stats->stats = $request->stats;
                            $stats->save();
                            $server->stats()->save($stats);
                            $player->stats()->save($stats);
                            return response()->json(["Data saved"],200);
                        }else{
                            $stats = new McStat();
                            $stats->stats = $request->stats;
                            $stats->save();
                            $server->stats()->save($stats);
                            $player->stats()->save($stats);
                            return response()->json(["Data saved"],201);
                        }

                    }
                    return response()->json(['error'=>'invaild fields',"errors"=>$validator->errors()],400);
                }
                return response()->json(["error" => "Unauthorized"], 403);

            }
            return response()->json(["error" => "Unauthenticated"], 401);

        }
        return response()->json(["error" => "Not found"], 404);
    }
}

