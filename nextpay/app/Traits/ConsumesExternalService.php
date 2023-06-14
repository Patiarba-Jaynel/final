<?php


namespace App\Traits;
// importing guzzle
use GuzzleHttp\Client;


trait ConsumesExternalService {

     /**
      *@return string
     */

     public function performRequest($method, $requestUrl, $form_params, $headers =[]) {

          $client = new Client([
               'base_uri' => $this->baseUri,
          ]);

          $response = $client->request($method, $requestUrl, [
               'body' => $form_params,
               'headers' => $headers
          ]);
          //->getContents()["choices"]["message"]["content"]
          return $response->getBody();
     }

     public function performRequeststatusCode($method, $requestUrl, $form_params, $headers =[]) {

          $client = new Client([
               'base_uri' => $this->baseUri,
          ]);

          $response = $client->request($method, $requestUrl, [
               'body' => $form_params,
               'headers' => $headers
          ]);
          //->getContents()["choices"]["message"]["content"]
          return $response->getStatusCode();
     }
}
