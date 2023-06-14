<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser{
    // build success responser
    // success reponser
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response($data, $code)->header('Content-Type', 'application/json');
    }

    public function errorResponse($message, $code)
    {
        return response()->json(
            [
            'error' => $message, 
            'code' => $code
            ], 
        $code);
    }

    public function errorNotFound($id, $message, $code) {
        return response()->json(
            [
                "id" => $id,
                "error" => $message,
                "code" => $code
            ],
            $code
        );
    }

    public function serverError($message, $code = Response::HTTP_INTERNAL_SERVER_ERROR) {
        return response->json(
            [
                "error" => $message,
                "code" => $code
            ]
            );
    }
}