<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FileFolders extends Model
{
    use HasFactory;
    protected $table = 'file_folders';

    public function files(){
        return $this->hasMany(FileUpload::class,"folder","uuid");
    }

    public function subFolders(){
        return $this->hasMany(FileFolders::class,"parent_folder","uuid");
    }

}
