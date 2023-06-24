<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\dalleService;
use App\Models\Token;
use App\Models\History;


class stableDiffusionController extends Controller
{
     use ApiResponser;

     public $dalleService;

     public function __construct(dalleService $dalleService)
     {
          $this->dalleService = $dalleService;
          $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout']]);
     }

     public function prompt(Request $request)
     {    
          $token = auth()->user()->tokens;

          $user_id = auth()->user()->id;
          $validation = ["prompt" => "required | string"];

          $this->validate($request, $validation);

          if ($token > 0)
          {
               $prompt = json_decode($this->dalleService->prompt($request->all()), true)["image"][0];

               Token::where('id', auth()->user()->id)->limit(1)->update(array("tokens" => $token - 1));

               History::create([
                    "ask" => request("prompt"),
                    "response" => $prompt,
                    "user_id" => $user_id
               ]);

               return $this->successResponse(["image" => $prompt]);
          }

          return $this->errorResponse("No account tokens", 403);

     }
}