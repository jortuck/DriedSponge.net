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
        //$alert->twitter = $this->twitter;
        //$alert->discord = $this->discord;
        $alert->onsite = $this->website;
        $alert->save();

    }
}
