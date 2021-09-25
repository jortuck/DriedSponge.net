<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FileFolders;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FileUploads extends Controller
{
    public function upload(Request $request)
    {
        if ($request->header('Authorization')) {
            if ($request->header('Authorization') == "Bearer " . config("extra.image_secret")) {
                $validator = Validator::make($request->all(), [
                    "image" => "required|file|max:99000|mimes:jpeg,webp,png,mp4,gif,mov,pdf"
                ]);
                if ($validator->passes()) {
                    $file = $request->file('image');
                    $extention = $file->extension();
                    $name = Str::random(20);
                    $isVideo = Str::contains($file->getMimeType(),"video");
                    $upload = new FileUpload();
                    $upload->name = $name . '.' . $extention;
                    $upload->type = $extention;
                    $upload->uuid = $name;
                    $responsejson = [
                        "success" => true,
                        "id" => $upload->uuid,
                        "url" =>  route('upload.load-view', $upload->uuid),
                        "raw_url" => $isVideo ? asset("/videos/". $upload->name) : route('upload.load-file', $upload->name)
                    ];
                    if ($request->set_delete_token) {
                        $deltoken = Str::random(64);
                        $upload->deleteToken = Hash::make($deltoken);
                        $responsejson['deletion_url'] = route('sharex.delete', ["uuid" => $upload->uuid, 'deltoken' => $deltoken]);
                    }
                    $upload->save();
                    $catergory = FileFolders::where("name",Str::upper($extention))->first();
                    if(!$catergory){
                        $catergory = new FileFolders();
                        $catergory->uuid = Str::random(15);
                        $catergory->name = Str::upper($extention);
                        $catergory->save();
                    }
                    $catergory->files()->save($upload);
                    if($isVideo){
                        $file->storePubliclyAs(
                            "public/videos", $upload->name
                        );
                    }else{
                        $file->storeAs(
                            "/uploads/$extention", $upload->name
                        );
                    }
                    return response()->json($responsejson)->setStatusCode(201);
                }
                return response()->json(["success" => false, "error" => "Invalid File", "errors" => $validator->errors()], 400);
            }
            return response()->json(["success" => false, "error" => "Unauthorized", "url" => "Unauthorized"], 403);
        }
        return response()->json(["success" => false, "error" => "Unauthenticated", "url" => "Unauthenticated"], 401);
    }

    public function sharexdelete(Request $request, $uuid, $deltoken)
    {
        $upload = FileUpload::where('uuid', $uuid)->whereNotNull("deleteToken")->first();
        if ($upload) { // Does the db entry exist
            if (Hash::check($deltoken, $upload->deleteToken)) { // Check token in db
                $upload->delete();
                return "<script>alert('Deleted Image');window.close();</script>";
            }
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        return response()->json(['error' => 'Not found'], 404);
    }
}
