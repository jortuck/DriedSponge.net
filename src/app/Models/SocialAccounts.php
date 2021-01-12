<?php

namespace App\Models;

use Carbon\Carbon;
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
        return $this->hasOne('App\Models\User','id', 'user_id');
    }

    public function updateInfo($socialite_response){
        $this->provider_id = $socialite_response->id;
        $this->provider_username = $socialite_response->nickname;
        $this->provider_email = $socialite_response->email;
        $this->provider_avatar = $socialite_response->avatar;
        $this->provider_token = $socialite_response->token;
        $this->provider_refresh_token = $socialite_response->refreshToken;
        $this->token_expires = Carbon::now()->addSeconds($socialite_response->expiresIn);
        $this->save();
    }
}
