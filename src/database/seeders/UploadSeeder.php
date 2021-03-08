<?php

namespace Database\Seeders;

use App\Models\FileFolders;
use App\Models\FileUpload;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
            foreach (Storage::allFiles('/uploads') as $file){
                $type = explode("/",Storage::mimeType($file))[1];
                echo "\n".$file;
                $data = new FileUpload();
                $data->type  = $type;
                $data->name =  explode("/",$file)[2];
                $data->uuid = explode(".",$data->name)[0];
                if(FileUpload::where("name",$data->name)->first()){
                    echo "\n $file - File already exist!";
                    continue;
                }
                $data->save();
                $type = FileFolders::where("mime_type",Storage::mimeType($file))->first();
                if(!$type){
                    $type = new FileFolders();
                    $type->extention =$type;
                    $type->mime_type=Storage::mimeType($file);
                    $type->save();
                }
                $type->files()->save($data);
                echo "\n $file - imported!";
            }
        }else {
            echo "\nNo images to import!";
        }
    }
}
