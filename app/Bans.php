<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bans extends Model
{
    //Table Name
    protected $table = 'bans';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User','steamid','user_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status','=',1);
    }
    public function scopeHistory($query)
    {
        return $query->get();
    }
    public function scopeInactive($query)
    {
        return $query->where('status','=','inactive');
    }
}
