<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ContactResponses extends Model
{
    use HasFactory;
    protected $table = 'contact';
    //Primary key
    public $primaryKey = 'id';
    protected $guarded = [];
    protected $fillable = [
        'Name', 'Email', 'Subject', 'Message', 'Read'
    ];

}
