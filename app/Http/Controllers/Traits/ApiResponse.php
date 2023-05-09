<?php

namespace App\Controllers\Traits;

use App\Enum\StatusCode;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponse{

    protected function successResponse($data, $message = null, $code = StatusCode::SUCCESS)
    {
        return response([
            'status'=> 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message = null, $code)
    {
        return response([
            'status'=>'Error',
            'message' => $message
        ], $code);
    }

}
