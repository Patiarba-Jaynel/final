<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\paymongoService;
use Illuminate\Support\Facades\Auth;


class paymongoController extends Controller
{
     use ApiResponser;

     public $paymongoService;

     public function __construct(paymongoService $paymongoService)
     {
          $this->paymongoService = $paymongoService;
          $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout']]);
     }

     public function pay(Request $request)
     {
          return $this->successResponse($this->paymongoService->pay($request->all()));
     }
}