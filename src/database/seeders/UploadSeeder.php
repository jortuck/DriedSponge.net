<?php

namespace Database\Seeders;

use App\Models\FileFolders;
use App\Models\FileUpload;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Storage::exists('/uploads')){
                $this->save('/uploads');
        }else {
            echo "\nNo images to import!";
        }
        if(Storage::exists('/public/videos')) {
            $this->save('/public/videos');
        }
    }

    public function save($directory){
        foreach (Storage::allFiles($directory) as $file){
            $type = explode("/",Storage::mimeType($file))[1];
            echo "\n".$file;
            $data = new FileUpload();
            $data->type  = $type;
            $data->mime_type  = Storage::mimeType($file);
            $data->name =  explode("/",$file)[2];
            $data->uuid = explode(".",$data->name)[0];
            $f = FileUpload::where("name",$data->name)->with('folder')->first();
            if($f){
                if($f->folder){
                    echo "\n $file - File already exist and so did the folder!";
                }else{
                    $folder = FileFolders::where("name",Str::upper($type))->first();
                    if(!$folder){
                        $folder = new FileFolders();
                        $folder->name =Str::upper($type);
                        $folder->uuid=Str::random(15);
                        $folder->save();
                    }
                    $folder->files()->save($f);
                    echo "\n $file - File already exist but the folder did not!";
                };
                continue;
            }
            $data->save();
            $folder = FileFolders::where("name", Str::upper($type))->first();
            if(!$folder){
                $folder = new FileFolders();
                $folder->name =Str::upper($type);
                $folder->uuid=Str::random(15);
                $folder->save();
            }
            $folder->files()->save($data);
            echo "\n $file - imported!";
        }
    }
}
