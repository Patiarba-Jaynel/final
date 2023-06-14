<?php

return [
     'paymongo' => [
          'base_uri' => env('PAYMONGO_SERVICE_BASE_URL'),
          'secret' => env('PAYMONGO_SERVICE_SECRET')
     ],
     'gpt' => ['base_uri' => env('GPT_SERVICE_BASE_URL')],
     'dalle' => ['base_uri' => env('DALLE_SERVICE_BASE_URL')]
];