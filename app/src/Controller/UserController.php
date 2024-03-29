<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\UserRepository;
use App\Validation\Validator;
use App\View\View;

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{
    // redirect to index
    public function index()
    {
        $userRepository = new UserRepository();

        $view = new View('user/index');
        $view->title = 'Benutzer';
        $view->heading = 'Benutzer';
        $view->users = $userRepository->readAll();
        $view->display();
    }

    // redirect to register
    public function register()
    {
        $view = new View('user/register');
        $view->title = 'Registrieren';
        $view->heading = 'Registrieren';
        $view->display();
    }

    // redirect to login
    public function login()
    {
        $view = new View('user/login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    // redirect to doLogin
    public function doLogin()
    {
        $authenticator = new Authentication();

        if(isset($_POST['send'])){
            $validator = new Validator();
            $validator->sanitizeData();

            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($authenticator->login($email, $password)) {
                // Anfrage an die URI /user/profile weiterleiten (HTTP 302)
                header('Location: /user/profile');
            } else {
                // Create new login view, with error
                $view = new View('user/login');
                $view->title = 'Login';
                $view->heading = 'Login';
                $view->error = true;
                $view->display();
            }
        }
    }

    // redirect to logout
    public function logout()
    {
        $authenticator = new Authentication();
        $authenticator->logout();

        header('Location: /user/login');
    }

    // redirect to doCreate
    public function doCreate()
    {
        if (isset($_POST['send'])) {
            $validator = new Validator();
            $validator->sanitizeData();

            $firstName = $_POST['fname'];
            $lastName = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $username = $_POST['username'];

            $userRepository = new UserRepository();
            $userRepository->create($firstName, $lastName, $email, $password, $username);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        $authenticator = new Authentication();
        $validator = new Validator();
        $validator->sanitizeData();
        
        if ($authenticator->login($email, $password)) {
            // Anfrage an die URI /user/profile weiterleiten (HTTP 302)
            header('Location: /user/profile');
        } else {
            // Create new login view, with error
            $view = new View('user/login');
            $view->title = 'Login';
            $view->heading = 'Login';
            $view->error = true;
            $view->display();
        }
        header('Location: /user/profile');
    }

    // redirect to profile
    public function profile()
    {
        $authenticator = new Authentication();

        //start session if it doesn't exist
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // check if user is authenticated
        $authenticator->restrictAuthenticated();

        $view = new View('user/profile');
        $view->title = 'Profil';
        $username = htmlspecialchars($_SESSION['firstname']);
        $view->heading = "Hallo $username";
        $view->display();
    }

    // save changes from input
    public function saveChangeUser()
    {
        //start session if it doesn't exist
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $userRepository = new UserRepository();
        $authenticator = new Authentication();
        $authenticator->restrictAuthenticated();

        // validate input
        $validator = new Validator();
        // sanitize $_POST-Array
        $validator->sanitizeData();

        if(isset($_POST) && !empty($_POST)){
            if($authenticator->checkPassword($_SESSION['id'], $_POST['password_old'])){
                if($userRepository->updateUser($_SESSION['id'], $_POST['username'], $_POST['password_new1'], $_POST['lastname'], $_POST['firstname'], $_POST['email'])){
                    // update user
                    $_SESSION['user'] = $_POST['username'];
                    $_SESSION['firstname'] = $_POST['firstname'];
                    $_SESSION['name'] = $_POST['lastname'];
                    $_SESSION['email'] = $_POST['email'];
                    header('Location: /user/profile');
                }
            } else {
                // get user by id
                $user = $authenticator->getAuthenticatedUser();
                // create data-populated view of changeUser site
                $view = new View('user/changeCredentials');
                $view->title = 'Profil';
                $view->heading = 'Benutzerdaten ändern';
                $view->username = htmlspecialchars($user->username);
                $view->lastname = htmlspecialchars($user->name);
                $view->firstname = htmlspecialchars($user->firstname);
                $view->email = htmlspecialchars($user->email);
                $view->wrongpwd = true;
                $view->display();
            }
        } else {
            
        }
    }

    // delete user
    public function delete()
    {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }

    // get request from user
    public function query()
    {
        // User id über get request holen
        $id = $_GET["q"];

        $userRepository = new UserRepository();
        // User nach dieser ID filtern
        $user = $userRepository->readById($id);

        // View dazu anzeigen
        $view = new View('user/query');
        $view->title = "{$user->username}";
        $view->heading = "Benuterprofil von {$user->username}";
        $view->user = $user;
        $view->display();
    }

    /**
     * Check if mail already exists in Database
     */
    public function checkEmail(){
        $userRepository = new UserRepository();
        $data = $userRepository->checkEmail($_POST['email']);
        
        if(isset($data)){
            // found email
            echo 1;
        }
        else {
            // found no email
            echo 0;
        }
    }
}
