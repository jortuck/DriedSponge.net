<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $fillable = [
        'username', 'steamid', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token'
    ];
    public $primaryKey = 'steamid';

    public function Bans(){
        return $this->hasMany('App\Bans','user_id','steamid');
    }
    public function IsBanned()
    {
        return $this->Bans()->Active()->first();
    }
    public function AllBans()
    {
        return $this->Bans()->History();
    }


}
