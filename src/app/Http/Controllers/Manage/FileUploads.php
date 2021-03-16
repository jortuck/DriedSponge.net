<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\FileFolders;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploads extends Controller
{
    function files(Request $request)
    {
        if (\Auth::guest()) {
            return response()->json(["error" => "Unauthenticated"], 401);
        }
        if (\Auth::user()->hasPermissionTo('File.See')) {
            if ($request->folder) {
                $folder = FileFolders::select("name", "uuid", "parent_folder")->where("uuid", $request->folder)->first();
                if (!$folder) {
                    return response()->json(['error' => 'Not found'], 404);
                }
                $parents = $folder->parents()->get();
                $folders = $folder->children()->select("name", "uuid", "created_at")->get();
                $files = $folder->files()->select("name", "uuid", "type", "created_at","id")->paginate(20);

                $files->transform(function ($item,$key) {
                    $path = $item->path();
                    if (Storage::exists($path)) {
                        $item->size = Storage::size($path);
                        $item->url = $item->url();
                        $item->mime_type = Storage::mimeType($path);
                    }
                    return $item;
                });



                return response()->json(['folders' => $folders, 'files' => $files, "parents" => $parents, "folder" => $folder]);
            } else {
                $folders = FileFolders::select("name", "uuid", "created_at")->whereNull("parent_folder")->get();
                $files = FileUpload::select("name", "uuid", "created_at", "folder")->whereNull('folder')->paginate(20);
                return response()->json(['folders' => $folders, 'files' => $files]);
            }

        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}
