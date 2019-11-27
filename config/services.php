<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'discord' => [
        'client_id'       => env('DISCORD_KEY'),
        'client_secret'   => env('DISCORD_SECRET'),
        'redirect'        => env('DISCORD_REDIRECT_URI'),
        'bot_key'         => env('DISCORD_BOT_KEY'),
        'guild_id'        => env('DISCORD_GUILD_ID')
    ],

];
