<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McPlayer extends Model
{
    use HasFactory;
    protected $table = 'mc_player';
    public $primaryKey = 'id';
    public $timestamps = true;
}
