<?php

namespace App\Authentication;

use App\Repository\UserRepository;
use RuntimeException;

class Authentication
{
    public static function login($email, $password)
    {
        $userRepository = new UserRepository();
        // Den Benutzer anhand der E-Mail oder des Benutzernamen auslesen
        $user = $userRepository->readByEmail($email);
		
        if ($user != null)
        {			
            // Prüfen ob der Password-Hash dem aus der Datenbank entspricht
            if (password_verify($password, $user->password))
            {
                //start session if it doesn't exist
                if (session_status() == PHP_SESSION_NONE){
                    session_start();
                }
                // Login successful
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $user->id;
                $_SESSION['user'] = $user->username;
                $_SESSION['firstname'] = $user->firstname;
                $_SESSION['name'] = $user->name;
                $_SESSION['email'] = $user->email;

                return true;
            }
        }

        return false;
    }

    public static function logout()
    {
        session_start();
        // unset all session variables
        unset($_SESSION['id']);
        unset($_SESSION['user']);
        unset($_SESSION ['loggedin']);
        unset($_SESSION['firstname']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);

        // Session destroy        
        session_destroy();
    }

    public static function isAuthenticated()
    {
        // Zurückgeben ob eine ID in der Session gespeichert wurde (true/false)
        return isset($_SESSION['id']) ? true : false;
    }

    public static function getAuthenticatedUser()
    {
        $userRepository = new UserRepository();
        session_start();

        // check if user is authenticated
        self::restrictAuthenticated();   
        // return User
        return $userRepository->readById($_SESSION['id']);
    }

    public static function restrictAuthenticated() {
        if (!self::isAuthenticated()) {
            throw new RuntimeException("Sie haben keine Berechtigung diese Seite anzuzeigen.");
            // Unbefungte Zugriffsversuche sollten immer geloggt werden
            // z.B. mit error_log()
            error_log($php_errormsg);
            exit();
        }
    }
}
