<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\EventsRepository;
use App\View\View;

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
        $view->events = $eventsRepository->readAllByJoin("user", "idOwner");
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
                $postDate = date_create($_POST['date']);
                $date = date_format($postDate, "Y-m-d H:i:s");
                $idOwner = $_SESSION["id"];

                $eventsRepository = new EventsRepository();
                $newEventId = $eventsRepository->create($title, $description, $date, $idOwner);
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
