<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\EventsRepository;
use App\View\View;

use DateTime;

class EventsController
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $eventsRepository = new EventsRepository();

        $view = new View('events/index');
        $view->heading = "Events";
        $view->title = "Events";
        $view->events = $eventsRepository->readAllByJoin("user", "idOwner", "adress", "idAdress");
        $view->display();
    }

    public function user()
    {
        $authentication = new Authentication();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($authentication->isAuthenticated()) {
            $userid = $_SESSION["id"];

            $eventsRepository = new EventsRepository();

            $view = new View('events/user');
            $view->heading = "Events";
            $view->title = "Meine Events";
            $view->events = $eventsRepository->readUserEvents($userid);
            $view->display();
        } else header('Location: /user/login');
    }

    public function create()
    {
        $authentication = new Authentication();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($authentication->isAuthenticated()) {
            $view = new View('events/create');
            $view->heading = "Event erstellen";
            $view->title = "Neues Event";
            $view->display();
        } else header('Location: /user/login');
    }

    public function doCreate()
    {
        $authentication = new Authentication();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($authentication->isAuthenticated()) {
            if (isset($_POST['send'])) {
                $title = $_POST['title'];
                $description = $_POST['description'];

                $postDate = new DateTime($_POST['date']);
                $postTime = new DateTime($_POST['time']);

                $merge = new DateTime($postDate->format('Y-m-d') .' ' .$postTime->format('H:i:s'));
                $date = $merge->format('Y-m-d H:i:s'); // Outputs '2017-03-14 13:37:42'
                $idOwner = $_SESSION["id"];
                $namePlace = isset($_POST['namePlace']) ? $_POST['namePlace'] : "null";
                $street = $_POST['street'];
                $streetNbr = isset($_POST['streetNbr']) ? $_POST['streetNbr'] : "null";
                $place = $_POST['place'];
                $plz = $_POST['plz'];

                $eventsRepository = new EventsRepository();
                
                $adressId = $eventsRepository->createAdress($namePlace, $street, $streetNbr, $place, $plz);
                $newEventId = $eventsRepository->create($title, $description, $date, $idOwner, $adressId);
                $eventsRepository->createJoin($idOwner, $newEventId);
            }

            header('Location: /events/user');
        } else header('Location: /user/login');
    }

    public function update()
    {
        $authentication = new Authentication();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($authentication->isAuthenticated()) {
            $eventsRepository = new EventsRepository();

            $view = new View('events/update');
            $view->heading = "Event ändern";
            $view->title = "Update Event";
            $view->event = $eventsRepository->readById($_GET["id"]);
            $view->display();
        } else header('Location: /user/login');
    }

    public function doUpdate()
    {
        $authentication = new Authentication();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($authentication->isAuthenticated()) {
            if (isset($_POST['send'])) {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $postDate = date_create($_POST['date']);
                $date = date_format($postDate, "Y-m-d H:i:s");
                $id = $_GET["id"];

                $eventsRepository = new EventsRepository();
                $eventsRepository->update($title, $description, $date, $id);
            }

            header('Location: /events/user');
        } else header('Location: /user/login');
    }

    public function delete()
    {
        $authentication = new Authentication();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($authentication->isAuthenticated()) {
            $id = $_GET["id"];

            $eventsRepository = new EventsRepository();
            $eventsRepository->deleteById($id);
            $eventsRepository->deleteReference($id);

            header('Location: /events/user');
        } else header('Location: /user/login');
    }
}
