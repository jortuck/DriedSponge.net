<?php

namespace App\Jobs;

use App\Models\Alerts;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendAlert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $twitter;
    protected $discord;
    protected $website;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message, $twitter, $discord, $website)
    {
        $this->message = $message;
        $this->twitter = $twitter;
        $this->discord = $discord;
        $this->website = $website;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $alert = new Alerts();
        $alert->message = $this->message;
        $alert->onsite = $this->website;
        if($this->twitter){
            $messagearray = str_split ($this->message,271);
            $count = count($messagearray);
            if($count == 1){
                $form = $messagearray[0];
            }else{
                $form = $messagearray[0]."... (1/$count)";
            }
            $tweet = \Twitter::postTweet(['status' => $form, 'format' => 'object']);
            $tweetlink =  \Twitter::linkTweet($tweet);
            $id=$tweet->id_str;
            $alert->tweetid = $id;
            $i = 0;
            foreach ($messagearray as $chunk){
                $i++;
                $end = "... ($i/$count)";
                if($i ==1){
                    continue;
                }elseif ($i==$count){
                    $end = " ($i/$count)";
                }
                $tweet2 = \Twitter::postTweet(['status' =>  $chunk.$end, 'format' => 'json','in_reply_to_status_id'=>$id]);
            }
        }
        if($this->discord){
            $fields = array();
            if($this->twitter){
                array_push($fields, array("name" => "Tweet Link", "value" => $tweetlink));
            }
            $embed = array(
                "title" =>  "New Message",
                "type" => "rich",
                "color" => hexdec("007BFF"),
                "timestamp" => date("c"),
                "fields" => $fields,
                "description"=>$this->message
            );
            $response = \Http::post(config('extra.discord_alerts_hook')."?wait=true",["embeds" => [$embed]])->object();
            $alert->discordid = $response->id;
        }
        $alert->save();

    }
}
