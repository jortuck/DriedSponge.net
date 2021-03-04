<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploads extends Controller
{
    public function loadFile(Request $request, $name)
    {
        $uuid = explode(".",$name)[0];
        $file = FileUpload::where("uuid",$uuid)->first();
        if ($file) {
            $path = $file->path();
            if(Storage::exists($path)) {
                $disk = Storage::get($path);
                $type = Storage::mimeType($path);
                if($request->get('download')){
                    return Storage::download($path);
                }else{
                    return response($disk, 200)->header('Content-Type', $type)->header("Content-Length",Storage::size($path))->header("pragma","public");
                }
            }else{
                $file->delete();
            }
        }
        return abort(404);
    }
    public function loadView(Request $request, $uuid){
        $file = FileUpload::where("uuid", $uuid)->first();
        if ($file) {
            $path =  $file->path();
            if(Storage::exists($path)){
                $disk = Storage::get($path);
                $type = Storage::mimeType($path);
                return view('images.image',[
                    'name'=>$file->name,
                    'type'=>$file->type,
                    "uuid"=>$uuid,
                    "mimeType"=>$type,
                    "rawUrl"=> $file->url(),
                    "size"=>Storage::size($path)/1000,
                    "created"=>$file->created_at
                ]);
            }else{
                $file->delete();
            }
        }
        return response()->view("images.notfound")->setStatusCode(404);
    }
}
