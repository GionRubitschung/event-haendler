<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Authentication\Authentication;
use App\Validation\Validator;
use App\View\View;

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{
    public function index()
    {
        $userRepository = new UserRepository();

        $view = new View('user/index');
        $view->title = 'Benutzer';
        $view->heading = 'Benutzer';
        $view->users = $userRepository->readAll();
        $view->display();
    }

    public function register()
    {
        $view = new View('user/register');
        $view->title = 'Benutzer erstellen';
        $view->heading = 'Benutzer erstellen';
        $view->display();
    }

    public function login()
    {
        $view = new View('user/login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function doLogin()
    {
        $authenticator = new Authentication();

        if(isset($_POST['send'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            if($authenticator->login($email, $password)){
                // Anfrage an die URI /user/profile weiterleiten (HTTP 302)
                header('Location: /user/profile');
            } else {
                // Anfrage an die URI /user/login weiterleiten (HTTP 302)
                header('Location: /user/login');
            }
        }
    }

    public function logout(){
        $authenticator = new Authentication();
        $authenticator->logout();

        header('Location: /user/login');
    }

    public function doCreate()
    {
        if (isset($_POST['send'])) {
            $firstName = $_POST['fname'];
            $lastName = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $username = $_POST['username'];

            $userRepository = new UserRepository();
            $userRepository->create($firstName, $lastName, $email, $password, $username);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }

    public function profile()
    {
        $authenticator = new Authentication();

        //start session if it doesn't exist
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }

        // check if user is authenticated
        $authenticator->restrictAuthenticated();

        $view = new View('user/profile');
        $view->title = 'Profil';
        $username = htmlspecialchars($_SESSION['firstname']);
        $view->heading = "Profil von $username";
        $view->display();
    }

    public function changeUser(){
        $authenticator = new Authentication();

        //start session if it doesn't exist
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }

        // get user by id
        $user = $authenticator->getAuthenticatedUser();

        $view = new View('user/changeCredentials');
        $view->title = 'Profil';
        $view->heading = 'Benutzerdaten ändern';
        $view->username = htmlspecialchars($user->username);
        $view->lastname = htmlspecialchars($user->name);
        $view->firstname = htmlspecialchars($user->firstname);
        $view->email = htmlspecialchars($user->email);
        $view->display();
    }

    public function saveChangeUser(){
        //start session if it doesn't exist
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }

        $authenticator = new Authentication();
        $authenticator->restrictAuthenticated();

        // validate input
        $validator = new Validator();
        $validator->sanitizePostArray();
        var_dump($_POST);
        

    }

    public function delete()
    {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }
}
