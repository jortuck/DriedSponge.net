<?php
return [
    'endpoint' => env('CLOUDFLARE_ENDPOINT',"https://api.cloudflare.com/client/v4/"),
    'zone' => env('CLOUDFLARE_ZONE',null),
    'token' =>env('CLOUDFLARE_TOKEN',null),
];
