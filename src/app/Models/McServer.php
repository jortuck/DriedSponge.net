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
}
