<?php
return [
    'limit_one_client' => env('LIMIT_DRAFTS_ONE_CLIENT', 20),
    'model_client' => \App\Models\Client::class,

    'is_enable_cache' => env('IS_ENABLE_CACHE_DRAFTS', false),
];
