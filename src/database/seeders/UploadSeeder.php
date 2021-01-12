<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
                $data = new \App\FileUpload();
                $data->type  = $type;
                $data->name =  explode("/",$file)[2];
                $data->uuid = explode(".",$data->name)[0];
                if(\App\FileUpload::where("name",$data->name)->first()){
                    echo "\n $file - File already exist!";
                    continue;
                }
                $data->save();
                echo "\n $file - imported!";
            }
        }else {
            echo "\nNo images to import!";
        }
    }
}
