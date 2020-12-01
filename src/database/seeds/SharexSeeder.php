<?php

use Illuminate\Database\Seeder;

class SharexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Storage::exists('/sharex')){
            foreach (Storage::allFiles('/sharex') as $file){
                $type = explode("/",Storage::mimeType($file))[1];
                echo "\n".$file;
                $data = new \App\SharexMedia();
                $data->type  = $type;
                $data->name =  explode("/",$file)[2];
                $data->uuid = explode(".",$data->name)[0];
                if(\App\SharexMedia::where("name",$data->name)->first()){
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
