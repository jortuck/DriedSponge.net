<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use xPaw\MinecraftQuery;
use xPaw\MinecraftQueryException;
use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;
class McStatusController extends Controller
{
    public function index(){
        $Query = new MinecraftQuery( );
        try
        {
            $Info = new MinecraftPing( 'mc.driedsponge.net', 25565 );
            $Query = array('success'=>true,'info'=>$Info->Query());
        }
        catch( MinecraftPingException $e )
        {
            $Query = array('success'=>false);
        }
        $log = preg_replace('/([0-9]+\\.[0-9]+\\.[0-9]+)\\.[0-9]+/', 'XX.XX.XX.XX', file_get_contents('/home/driedsponge/servers/mc/1.16.1/logs/latest.log'));
        $log ='test';
        return view('pages.mc')->with('query', $Query)->with('log',$log);
    }
    public function log(){
        $log = preg_replace('/([0-9]+\\.[0-9]+\\.[0-9]+)\\.[0-9]+/', 'XX.XX.XX.XX', file_get_contents('/home/driedsponge/servers/mc/1.16.1/logs/latest.log'));
        $log ='test';
        $response = Response::make($log, 200);
        $response->header('Content-Type', 'text/plain');
        return $response;
    }
}
