<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponser;

class gptService
{
     use ConsumesExternalService;

     public $baseUri;
     public $secret;
     public function __construct()
     {
          $this->baseUri = config("services.gpt.base_uri");
          $this->secret = config("services.gpt.secret");
     }

     public function chat($data){
          return $this->performRequest("POST", '/v1/chat', $data);
     }

}