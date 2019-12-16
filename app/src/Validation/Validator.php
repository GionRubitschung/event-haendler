<?php

namespace App\Validation;

class Validator
{
    /**
     * Sanitize POST array from special chars
     */
    public static function sanitizeData(){
        if(isset($_POST) && !empty($_POST)){
            foreach($_POST as $key => $value){
                // if key contains password i.e. password & password_old won't be escaped + sanitized
                if(strpos($key, 'password') !== false){
                    // do not sanitize password, will he hashed anyway
                } else {
                    $_POST[$key] = addslashes(htmlspecialchars($value));
                }
            }
        }
    }
}
