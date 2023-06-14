<?php

namespace App\Http\Controllers;
use App\Traits\ConsumesExternalService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;


class paymongoController extends Controller
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
        $this->baseUri = config('services.URL.url');
    }


    public function payment(Request $request)
    {   
        $API_KEY = base64_encode(config('services.API_KEY.key'));

        $headers = [
            "Authorization" => "Basic"." ".$API_KEY,
            'content-type' => 'application/json'
        ];

        $email = request("email");

        $data = '{"data":{"attributes":{"billing":{"email":"'.$email.'"},"line_items":[{"currency":"PHP","amount":10000,"description":"PAYMENT","name":"GPT SUBSCRIPTION","quantity":1}],"payment_method_types":["gcash"],"send_email_receipt":false,"show_description":true,"show_line_items":true,"description":"'.$email.'"}}}';

        $validation = [
            "email" => "required | email"
        ];

        $this->validate($request, $validation);



        $urlRequest = $this->performRequest("POST", "/v1/checkout_sessions",  $data, $headers);


        $response = [
            "checkout_url" => json_decode($urlRequest)->data->attributes->checkout_url
        ];

        return $this->successResponse($response);
    }

    
}
