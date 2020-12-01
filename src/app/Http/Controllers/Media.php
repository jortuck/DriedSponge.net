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
            $path = "/sharex/" . $file->type . "/" . $file->name;
            if(Storage::exists($path)) {
                $disk = Storage::get($path);
                $type = Storage::mimeType($path);
                if($request->get('download')){
                    return Storage::download($path);
                }else{
                    return response($disk, 200)->header('Content-Type', $type);
                }
            }else{
                $file->delete();
            }
        }
        return abort(404);
    }
    public function loadView(Request $request, $uuid){
        $file = SharexMedia::where("uuid", $uuid)->first();
        if ($file) {
            $path = "/sharex/" . $file->type . "/" . $file->name;
            if(Storage::exists($path)){
                $disk = Storage::get($path);
                $type = Storage::mimeType($path);
                return view('images.image',[
                    'name'=>$file->name,
                    'type'=>$file->type,
                    "uuid"=>$uuid,
                    "mimeType"=>$type,
                    "rawUrl"=>route('media.load-file',$uuid),
                    "size"=>Storage::size($path)/1000,
                    "created"=>$file->created_at
                ]);
            }else{
                $file->delete();
            }
        }
        return response()->view("images.notfound")->setStatusCode(200);
    }
}
