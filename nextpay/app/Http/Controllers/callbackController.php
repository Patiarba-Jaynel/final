<?php

namespace App\Http\Controllers;
use App\Traits\ConsumesExternalService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;

use App\Models\User;

class callbackController extends Controller
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


    public function callback(Request $request)
    {

     $API_KEY = base64_encode(config('services.API_KEY.key'));

     $headers = [
         "Authorization" => "Basic"." ".$API_KEY,
         'content-type' => 'application/json'
     ];

     $response = request("data");


     $data = $request->all();

     $email = $data["data"]["attributes"]["data"]["attributes"]["billing"]["email"];
     $payment_init_id = $data["data"]["attributes"]["data"]["attributes"]["payment_intent_id"];
     $tokens = $data["data"]["attributes"]["data"]["attributes"]["amount"];

     

     $url = "/v1/payment_intents/".$payment_init_id."";

     $urlRequest = $this->performRequeststatusCode("GET",$url, null, $headers);

     $currentUserToken = User::where('email', $email)->firstOrFail()->tokens;

     $user = User::where('email', $email)->limit(1)->update(array("tokens" => ($tokens / 100) + $currentUserToken));

     return $this->successResponse($user);

    }

    
}
