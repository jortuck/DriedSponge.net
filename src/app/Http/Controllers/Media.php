<?php

namespace App\Http\Controllers;

use App\SharexMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Media extends Controller
{
    public function loadFile(Request $request, $uuid)
    {
        $file = SharexMedia::where("uuid", $uuid)->first();
        if ($file) {
            $disk = Storage::get("/media/" . $file->type . "/" . $file->name);
            $type = Storage::mimeType("/media/" . $file->type . "/" . $file->name);
            return response($disk, 200)->header('Content-Type', $type);
        }
        return abort(404);
    }
    public function loadView(Request $request, $uuid){
        $file = SharexMedia::where("uuid", $uuid)->first();
        if ($file) {
            $disk = Storage::get("/media/" . $file->type . "/" . $file->name);
            $type = Storage::mimeType("/media/" . $file->type . "/" . $file->name);
            return view('images.image',['name'=>$file->name,'type'=>$file->type,"uuid"=>$uuid]);
        }
        return abort(404);
    }
}
