<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alerts extends Model
{
    //Table Name
    protected $table = 'alerts';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
}
