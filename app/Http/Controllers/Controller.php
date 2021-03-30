<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // response api function
    public function response($code = 200, $data = [], $message = '', $errors = [], $status = true)
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'data' => $data,
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
