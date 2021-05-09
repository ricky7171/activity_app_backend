<?php

namespace App\Exceptions;

use Exception;

class SearchDataFailedException extends Exception {

    public static function getCodeException()
    {
        return "E-0026";
    }

    public static function render($message) {
        if($message == "")
        {
            $message = "undefined error";
        }
        return response()->json([
            "error" => true,
            "code" => "E-0026",
            "message" => [
                $message
            ]
            ],500);
    }
}