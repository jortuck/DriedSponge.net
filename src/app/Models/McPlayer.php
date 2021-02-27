<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McPlayer extends Model
{
    use HasFactory;
    protected $table = 'mc_players';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected static function booted()
    {
        static::deleted(function ($server) {
            $server->stats()->delete();
        });
    }

    public function servers(){
        return $this->belongsToMany(McServer::class)->withTimestamps();
    }
    public function stats(){
        return $this->hasMany(McStat::class,'user_id','id');
    }
}
