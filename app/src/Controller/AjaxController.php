<?php
namespace App\Controller;

use App\Authentication\Authentication;
use App\Validation\Validator;

class AjaxController{
    public function checkPassword(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if(isset($_POST['password_old']) && !empty($_POST['password_old'])){
            $validator = new Validator();
            $validator->sanitizeData();

            $authentication = new Authentication();
            echo (json_encode($authentication->checkPassword($_SESSION['id'], $_POST['password_old'])));
        } else {
            echo json_encode(false);
        }
    }

    
}
    