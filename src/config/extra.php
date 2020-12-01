<?php

return [
    'github_webhook_url' => env('GUTHUB_DISCORD_WEBHOOKURL'),
    'github_webhook_secret' => env('GITHUB_WEBHOOK_SECRET'),

    'discord_alerts_hook' =>env('DISCORD_ALERTS_HOOK'),
    'discord_notification_hook'=>env('DISCORD_NOTIFICATION_HOOK'),

    'captcha_secret' => env('CAPTCHASECRET'),
    'captcha_site_key'=>env('CAPTCHA_SITEKEY'),

    'image_domain'=>env('IMAGE_DOMAIN','i.localhost'),
    'image_secret'=>env('IMAGE_UPLOAD_SECRET','peepeeepoopoo')

];
