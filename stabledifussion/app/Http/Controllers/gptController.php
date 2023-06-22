<?php

namespace App\Http\Controllers;
use App\Traits\ConsumesExternalService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;


class gptController extends Controller
{
    use ConsumesExternalService;
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = "https://api.openai.com";
    }

    
    public function chat(Request $request)
    {   
        $API_KEY = config('services.API_KEY.key');

        $headers = [
            "Authorization" => "Bearer"." ".$API_KEY,
            'content-type' => 'application/json'
        ];

        $data = [
            "prompt" => request("prompt"),
            "n" => 1,
            "size" => "1024x1024"
        ];

        $validation = [
            "prompt" => "required | string"
        ];

        $this->validate($request, $validation);

        $urlRequest = $this->performRequest("POST", "/v1/images/generations",  json_encode($data), $headers);

        
        $response = [
            "prompt" => json_decode($urlRequest)->data
        ];
        

        return $this->successResponse($response);
    }

    
}
