<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Models\History;

class historyController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $baseUri;

    public function __construct()
    {
    }

    
    public function history(Request $request)
    {   
        $id = request("id");
        $response = History::where('user_id', $id)->get();
        return $this->successResponse($response);
    }

}
