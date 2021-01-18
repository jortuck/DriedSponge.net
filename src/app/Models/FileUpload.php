<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    //Table Name
    protected $table = 'file_uploads';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
}
