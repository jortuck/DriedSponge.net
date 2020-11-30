<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\SharexMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Media extends Controller
{
    public function upload(Request $request){
        $file = $request->file('image');
        $extention = $file->extension();
        if($file->getSize()<99000000) {
            $upload = new SharexMedia();
            $upload->name = $request->file('image')->getClientOriginalName();
            $upload->type = $extention;
            $upload->uuid = Str::random(10);
            $upload->save();

            return $upload->uuid;
        }
        return "TOOBIG";
    }
}
