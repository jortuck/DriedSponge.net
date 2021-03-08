<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\FileFolders;
use Illuminate\Http\Request;

class FileUploads extends Controller
{
    function types(Request $request){
        if(\Auth::guest()){
            return response()->json(["error"=>"Unauthenticated"],401);
        }
        if (\Auth::user()->hasPermissionTo('File.See')) {
            $responses = FileFolders::select("mime_type","extention")->get();
            return response()->json($responses);
        }else{
            return response()->json(['error' => 'Unauthorized'],403);
        }
    }
}
