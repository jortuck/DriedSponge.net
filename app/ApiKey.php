<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ApiKey extends Authenticatable
{
    //Table Name
    protected $table = 'api_keys';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    protected $fillable = [
        'key', 'name','current_usage'
    ];

}
