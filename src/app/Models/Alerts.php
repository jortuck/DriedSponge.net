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
        if($this->tweetid){
            $tweet = \Twitter::destroyTweet($this->tweetid);
        }
        $this->delete();
        return true;
    }
    public function deleteTweet()
    {
        if($this->tweetid){
            $tweet = \Twitter::destroyTweet($this->tweetid);
            $this->tweetid = null;
            return true;
        }
    }
}
