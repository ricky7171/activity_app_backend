<?php

namespace App\Exceptions;

use Exception;

class GetHistoryRangeFailedException extends Exception {

    public static function getCodeException()
    {
        return "E-0027";
    }

    public static function render($message) {
        if($message == "")
        {
            $message = "undefined error";
        }
        return response()->json([
            "error" => true,
            "code" => "E-0027",
            "message" => [
                $message
            ]
            ],500);
    }
}