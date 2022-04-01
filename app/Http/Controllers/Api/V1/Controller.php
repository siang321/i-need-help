<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function response_method($status, $message=null, $data=[])
    {
        if (empty($message)) {
            if ($status == 200 || $status == 201) {
                $message = "Success";
            }
        }

        return
        [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
    }
}
