<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\gptService;
use App\Models\Token;
use App\Models\History;


class gptController extends Controller
{
     use ApiResponser;

     public $gptService;

     public function __construct(gptService $gptService)
     {
          $this->gptService = $gptService;
          $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout']]);
     }

     public function chat(Request $request)
     {    
          $token = auth()->user()->tokens;
          
          $user_id = auth()->user()->id;
          $validation = ["messages" => "required | string"];

          $this->validate($request, $validation);

          if ($token > 0)
          {

               $messages = json_decode($this->gptService->chat($request->all()), true)["messages"];

               
               Token::where('id', auth()->user()->id)->limit(1)->update(array("tokens" => $token - 1));

               History::create([
                    "ask" => request("messages"),
                    "response" => substr($messages, 0, 20)."...",
                    "user_id" => $user_id
               ]);

               return $this->successResponse(["messages" => $messages]);
          }

          return $this->errorResponse("No account tokens", 403);

     }
}