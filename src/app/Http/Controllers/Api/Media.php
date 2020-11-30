<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\SharexMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Media extends Controller
{
    public function upload(Request $request){
        $file = $request->file('image');
        $extention = $file->extension();
        $name = $request->file('image')->getClientOriginalName();
        if($file->getSize()<99000000) {
            $upload = new SharexMedia();
            $upload->name = $name;
            $upload->type = $extention;
            $upload->uuid = Str::random(10);
            $upload->save();
            $file->storeAs(
                "/media/$extention", $name
            );
            return response()->json(["success"=>false,"error"=>"The file you tried to send is too big","id"=>$upload->uuid]);

        }
        return response()->json(["success"=>false,"error"=>"The file you tried to send is too big","id"=>"BIG"]);
    }
}
