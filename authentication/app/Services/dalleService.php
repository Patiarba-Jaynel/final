<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;


class dalleService
{
     use ConsumesExternalService;


     public $baseUri;

     public function __construct()
     {
          $this->baseUri = config("services.dalle.base_uri");
          $this->secret = config("services.dalle.secret");
     }

     public function prompt($data){

          $user = auth()->user();

          $id = $user->id;

          $tokens = $user->tokens;

          $fill = Token::where('id', $id)->firstOrFail()->fill(["tokens" => $tokens - 1]);

          return $this->performRequest("POST", '/v1/chat/image', $data);
     }

}