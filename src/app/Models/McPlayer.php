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

    public function servers(){
        return $this->belongsToMany(McServer::class)->withTimestamps();
    }
    public function stats(){
        return $this->hasMany(McStat::class,'user_id','id');
    }
}
