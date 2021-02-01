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
    public function index()
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
        $mcserver = McServer::select("name", "ip", "port", "description")->where('private', false)->where('slug', $slug)->first();
        if (!$mcserver) {
            return response()->json(["error" => "Not found"], 404);
        }
        try {
            $ping = new MinecraftPing($mcserver->ip, $mcserver->port, 2, false);
            $status = $ping->Query();
            $status['description']['text'] = MinecraftColors::convertToHTML($status['description']['text']);
            $mcserver->online = true;
            $mcserver->status = $status;

        } catch (MinecraftPingException $e) {
            $mcserver->status = false;
            $mcserver->online = false;
            $mcserver->error = $e->getMessage();
        }
        return response()->json(["success" => "true", "data" => $mcserver]);
    }
}
