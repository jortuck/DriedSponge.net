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
        $name = Str::random(10);
        if($file->getSize()<99000000) {
            $upload = new SharexMedia();
            $upload->name =  $name.'.'.$extention;
            $upload->type = $extention;
            $upload->uuid = $name;
            $upload->save();
            $file->storeAs(
                "/media/$extention",  $upload->name
            );
            return response()->json(["success"=>true,"id"=>$upload->uuid,"url"=>route('media.load-view',$upload->uuid),"raw_url"=>route('media.load-file',$upload->uuid)]);

        }
        return response()->json(["success"=>false,"error"=>"The file you tried to send is too big","id"=>"BIG"]);
    }
}
