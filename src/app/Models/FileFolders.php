<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileFolders extends Model
{
    use HasFactory;
    protected $table = 'file_folders';

    public function files(){
        return $this->hasMany(FileUpload::class,"file_type","id");
    }
}
