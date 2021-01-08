<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccounts extends Model
{
    public $primaryKey = 'id';
    protected $fillable = [
        'provider', 'provider_id', 'user_id'
    ];
    protected $table = 'social_accounts';

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
