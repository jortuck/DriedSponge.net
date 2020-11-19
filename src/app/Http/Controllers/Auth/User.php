<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class User extends Controller
{
    public function me(Request $request){
        $authuser = \Auth::user();
        $perms =  \DB::table('permissions')->select('name','id')->orderBy('name', 'asc')->where('guard_name','web')->get();
        $userperms =array();
        foreach ($perms as $perm){
            if(\Auth::guest()){
                $userperms[$perm->name] = false;
            }else{
                if($authuser->hasPermissionTo($perm->name)){
                    $userperms[$perm->name] = true;
                }else{
                    $userperms[$perm->name] = false;
                }
            }

        }
        $user=[
            $authuser,
            $userperms
        ];
        return response()->json($user, 200);
    }

    public function can(Request $request, $pname){
        return response()->json(["can"=>\Auth::user()->hasPermissionTo($pname)], 200);
    }


}
