<?php

namespace App\Http\Controllers\Manage;

use App\ContactResponses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Contact extends Controller
{
    function index(Request $request){
        if(\Auth::guest()){
            return response()->json(['error' => 'Unauthorized'])->setStatusCode(401);
        }
        if (\Auth::user()->hasPermissionTo('Contact.See')) {
            $responses = ContactResponses::select('id','Name','Email','Subject','created_at')->paginate(10);
            return response()->json($responses);
        }else{
            return response()->json(['error' => 'Unauthenticated'])->setStatusCode(403);
        }
    }
}
