<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Alerts extends Model
{
    use HasFactory;

    //Table Name
    protected $table = 'alerts';
    //Primary key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;

    public function deleteFull()
    {
        $this->deleteTweet();
        $this->deleteDiscord();
        $this->delete();
        return true;
    }
    public function deleteTweet()
    {
        if($this->tweetid){
            try {
                \Twitter::destroyTweet($this->tweetid);
            }catch(\RuntimeException $e){}
            $this->tweetid = null;
            $this->save();
            return true;
        }
    }
    public function deleteDiscord()
    {
        if($this->discordid){
            $delete =\Http::delete(config('extra.discord_alerts_hook')."/messages/".$this->discordid);
            if($delete->successful() or $delete->status() == 404){
                $this->discordid = null;
                $this->save();
            }
            return true;
        }
    }
}
