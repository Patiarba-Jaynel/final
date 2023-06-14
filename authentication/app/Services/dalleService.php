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
          return $this->performRequest("POST", '/v1/chat/image', $data);
     }

}