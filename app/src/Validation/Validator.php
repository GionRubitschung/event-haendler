<?php

namespace App\Validation;

class Validator
{
    /**
     * Sanitize POST array from special chars
     */
    public static function sanitizePostArray(){
        foreach($_POST as $key => $value){
            $_POST[$key] = htmlspecialchars($value);
        }
    }
}
