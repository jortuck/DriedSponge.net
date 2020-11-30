<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SharexMedia extends Model
{
    //Table Name
    protected $table = 'sharex_media';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
}
