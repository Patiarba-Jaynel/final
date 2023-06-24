<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Services\historyService;
use App\Models\History;


class historyController extends Controller
{
     use ApiResponser;

     public $historyService;

     public function __construct(historyService $historyService)
     {
          $this->historyService = $historyService;
          $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout']]);
     }

     public function history()
     {    
        return $this->successResponse($this->historyService->history(["id" => auth()->user()->id]));
     }
}