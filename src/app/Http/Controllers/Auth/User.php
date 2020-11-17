<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class User extends Controller
{
    public function me(Request $request){
        return response()->json(\Auth::user(), 200);
    }

    public function can(Request $request, $pname){
        return response()->json(["can"=>\Auth::user()->hasPermissionTo($pname)], 200);
    }


}
