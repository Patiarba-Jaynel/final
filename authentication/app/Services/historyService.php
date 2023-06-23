<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponser;

class historyService
{
     use ConsumesExternalService;

     public $baseUri;
     public $secret;
     public function __construct()
     {
          $this->baseUri = config("services.history.base_uri");
          $this->secret = config("services.history.secret");
     }

     public function history($data){
          return $this->performRequest("POST", '/v1/history', $data);
     }

}