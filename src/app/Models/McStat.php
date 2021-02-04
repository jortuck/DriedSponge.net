<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McStat extends Model
{
    use HasFactory;
    protected $table = 'mc_stats';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function player(){
        return $this->hasOne(McPlayer::class,'id','user_id');
    }

    public function server(){
        return $this->hasOne(McServer::class,'id','server_id');
    }
}
