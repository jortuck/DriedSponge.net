<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\SharexMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Media extends Controller
{
    public function upload(Request $request)
    {
        if($request->header('Authorization')){
            if($request->header('Authorization') == "Bearer ".config("extra.image_secret")){
                $validator = Validator::make($request->all(), [
                    "image" => "required|file|max:99000|mimes:jpeg,webp,png,mp4,gif,mov"
                ]);
                if ($validator->passes()) {
                    $file = $request->file('image');
                    $extention = $file->extension();
                    $name = Str::random(10);
                    $upload = new SharexMedia();
                    $upload->name = $name . '.' . $extention;
                    $upload->type = $extention;
                    $upload->uuid = $name;
                    $upload->save();
                    $file->storeAs(
                        "/sharex/$extention", $upload->name
                    );
                    return response()->json(["success" => true, "id" => $upload->uuid, "url" => route('media.load-view', $upload->uuid), "raw_url" => route('media.load-file', $upload->uuid)]);
                }
                return response()->json(["success" => false, "error" => "Invalid File","errors"=>$validator->errors()],500);
            }
            return  response()->json(["success"=>false,"error"=>"Unauthorized","url"=>"Unauthorized"],403);
        }
        return  response()->json(["success"=>false,"error"=>"Unauthenticated","url"=>"Unauthenticated"],401);
    }
}
