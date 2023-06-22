<?php

namespace App\Http\Controllers;
use App\Traits\ConsumesExternalService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;


class stableController extends Controller
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
        $this->baseUri = "https://stablediffusionapi.com";
    }

    
    public function generateImage(Request $request)
    {   
        $API_KEY = config('services.API_KEY.key');

        $headers = [
            'Content-Type' => 'application/json'
        ];
        
        $data = [
            "key" => $API_KEY, 
            "prompt" => request("prompt"), 
            "negative_prompt" => null, 
            "width" => "512", 
            "height" => "512", 
            "samples" => "1", 
            "num_inference_steps" => "20", 
            "seed" => null, 
            "guidance_scale" => 7.5, 
            "safety_checker" => "yes", 
            "multi_lingual" => "no", 
            "panorama" => "no", 
            "self_attention" => "no", 
            "upscale" => "no", 
            "embeddings_model" => "embeddings_model_id", 
            "webhook" => null, 
            "track_id" => null 
        ];

        $validation = [
            "prompt" => "required | string"
        ];

        $this->validate($request, $validation);

        $urlRequest = $this->performRequest("POST", "/api/v3/text2img",  json_encode($data), $headers);

        
        $response = [
            "image" => json_decode($urlRequest)->output
        ];
        
        return $this->successResponse($response);
    }

}
