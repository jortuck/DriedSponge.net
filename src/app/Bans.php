<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Bans
 *
 * @property int $id
 * @property string $user_id
 * @property string|null $reason
 * @property string $admin_steamid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $status
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bans active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bans history()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bans inactive()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bans newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bans newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bans query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bans whereAdminSteamid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bans whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bans whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bans whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bans whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bans whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bans whereUserId($value)
 * @mixin \Eloquent
 */
class Bans extends Model
{
    //Table Name
    protected $table = 'bans';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User','steamid','user_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status','=',1);
    }
    public function scopeHistory($query)
    {
        return $query->get();
    }
    public function scopeInactive($query)
    {
        return $query->where('status','=','inactive');
    }
}
