<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class CloudflareDeletetion implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url)
    {
       $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = ["files"=>[$this->url]];
        Http::asJson()->withToken(config("cloudflare.token"))->post("https://api.cloudflare.com/client/v4/zones/".config("cloudflare.zone")."/purge_cache", $data);
    }
}
