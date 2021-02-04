<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McServer extends Model
{
    use HasFactory;
    //Table Name
    protected $table = 'mc_servers';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    protected static function booted()
    {
        static::deleted(function ($server) {
            $server->stats()->delete();
        });
    }

    public function stats()
    {
        return $this->hasMany(McStat::class,'server_id','id');
    }

    public function players()
    {
        return $this->belongsToMany(McPlayer::class)->withTimestamps();
    }
}
