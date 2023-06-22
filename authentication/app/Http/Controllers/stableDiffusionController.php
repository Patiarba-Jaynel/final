<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\dalleService;
use App\Models\Token;


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


          $validation = ["prompt" => "required | string"];

          $this->validate($request, $validation);

          if ($token > 0)
          {
               Token::where('id', auth()->user()->id)->limit(1)->update(array("tokens" => $token - 1));
               return $this->successResponse($this->dalleService->prompt($request->all()));
          }

          return $this->errorResponse("No account tokens", 403);

     }
}