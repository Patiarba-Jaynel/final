<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\gptService;
use App\Models\Token;


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

          if ($token > 0)
          {
               Token::where('id', auth()->user()->id)->limit(1)->update(array("tokens" => $token - 1));
               return $this->successResponse($this->gptService->chat($request->all()));
          }

          return $this->errorResponse("No account tokens", 403);

     }
}