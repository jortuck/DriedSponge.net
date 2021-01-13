<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactResponses extends Model
{
    protected $table = 'contact';
    //Primary key
    public $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'Name', 'Email', 'Subject', 'Message', 'Read'
    ];

}
