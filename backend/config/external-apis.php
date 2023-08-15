<?php

return [
    'weatherProvider' => env('WEATHER_PROVIDER', 'blue-sky'),
    'blue-sky' => [
        'base_url' => 'https://api.blueskyapi.io',
        'api_key' => env('BLUESKY_API_KEY', null),
    ],
];
