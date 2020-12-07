<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

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
