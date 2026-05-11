<?php

namespace App\Traits;

trait ApiResponses{
    protected function ok ($message) {
        return $this -> success($message, 200);
    }


    protected function success( $message, $statuscode = 200){
        return response() -> json([
            "massage" => $message,
            "status" => $statuscode,
    ], $statuscode);
    }
};
