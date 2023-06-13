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

        $message = [
            "role" => "user",
            "content" => request("messages")
        ];

        $data = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                $message
            ]
        ];

        $validation = [
            "messages" => "required | string"
        ];

        $this->validate($request, $validation);

        $urlRequest = $this->performRequest("POST", "/v1/chat/completions",  json_encode($data), $headers);


        $response = [
            "messages" => json_decode($urlRequest)->choices[0]->message->content
        ];

        return $this->successResponse($response);
    }

    
}
