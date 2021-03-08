<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileType extends Model
{
    use HasFactory;
    protected $table = 'file_types';

    public function files(){
        return $this->hasMany(FileUpload::class,"file_type","id");
    }
}
