<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiKeys extends Model
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
