<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasPermissions;
use Str;

class ApiKey extends Model
{
    use HasPermissions;
    //Table Name
    protected $table = 'api_keys';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    protected $fillable = [
        'api_token', 'name','current_usage'
    ];
    public function RegenToken(){
        $this->api_token=Str::uuid();
        $this->save();
    }
    public function UpdateUsage(){
        $current = $this->current_usage + 1;
        $this->current_usage = $current;
        $this->save();
    }

}
