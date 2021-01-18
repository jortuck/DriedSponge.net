<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annoucement extends Model
{
    //Table Name
    protected $table = 'annoucement';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
}
