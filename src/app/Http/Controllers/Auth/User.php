<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class User extends Controller
{
    public function me(Request $request){


        $authuser = Auth::user();
        $perms =  \DB::table('permissions')->select('name','id')->orderBy('name', 'asc')->where('guard_name','web')->get();
        $userperms = $perms->keyBy('name');
        foreach ($perms as $perm){
            $userperms[$perm->name] =  !Auth::guest() && $authuser->hasPermissionTo($perm->name);
        }
        if($authuser){
            $accounts = Auth::user()->social_accounts()->select('provider_id','provider','provider_username','provider_avatar','created_at')->get();
            $connections = $accounts->keyBy('provider');
        }else{
            $connections = null;
        }

        $user=[
            "user"=>$authuser,
            "permissions"=>$userperms,
            'connections'=>$connections,

        ];

        return response()->json($user, 200);
    }

    public function can(Request $request, $pname){
        return response()->json(["can"=>\Auth::user()->hasPermissionTo($pname)], 200);
    }


}
