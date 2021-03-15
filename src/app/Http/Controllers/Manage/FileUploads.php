<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\FileFolders;
use App\Models\FileUpload;
use Illuminate\Http\Request;

class FileUploads extends Controller
{
    function files(Request $request){
        if(\Auth::guest()){
            return response()->json(["error"=>"Unauthenticated"],401);
        }
        if (\Auth::user()->hasPermissionTo('File.See')) {
            if($request->folder){
                $folder = FileFolders::where("uuid",$request->folder)->first();
                if(!$folder){
                    return response()->json(['error' => 'Not found'],404);
                }
                $folders = $folder->subFolders()->select("name","uuid","created_at")->get();
                $files = $folder->files()->select("name","uuid","type","mime_type","created_at")->get();
            }else{
                $folders = FileFolders::select("name","uuid","created_at")->get();
                $files = FileUpload::select("name","uuid","created_at","folder")->whereNull('folder')->get();
            }
            return response()->json(['folders'=>$folders,'files'=>$files]);
        }else{
            return response()->json(['error' => 'Unauthorized'],403);
        }
    }
}
