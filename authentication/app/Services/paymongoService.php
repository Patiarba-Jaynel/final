<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;


class paymongoService
{
     use ConsumesExternalService;


     public $baseUri;

     public $secret;

     public function __construct()
     {
          $this->baseUri = config("services.paymongo.base_uri");
          $this->secret = config("services.paymongo.secret");

     }

     public function pay($data){
          return $this->performRequest("POST", '/v1/payment', $data);
     }

}