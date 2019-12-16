<?php

namespace App\Controller;

use App\Authentication\Authentication;
use App\Repository\EventsRepository;
use App\Validation\Validator;
use App\View\View;

use DateTime;

/**
 * Siehe Dokumentation im DefaultController.
 */
class EventsController
{
    // Startseite für events
    public function index()
    {
        // Wenn keine session gestarte ist wird eine gestartet
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
        // Wenn keine session gestarte ist wird eine gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $authentication = new Authentication();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Wenn der Benutzer angemeldet ist, kann er seine eigenen events anzeigen
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

        // Wenn keine session gestarte ist wird eine gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Wenn der Benutzer angemeldet ist, kann er events erstellen
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

        // Wenn keine session gestarte ist wird eine gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Wenn der Benutzer angemeldet ist, kann er events erstellen
        if ($authentication->isAuthenticated()) {
            if (isset($_POST['send'])) {
                $validator = new Validator();
                // Die daten werden entschärft
                $validator->sanitizeData();

                $title = $_POST['title'];
                $description = $_POST['description'];

                // Die beiden Dati werden von strings zu dati geändert
                $postDate = new DateTime($_POST['date']);
                $postTime = new DateTime($_POST['time']);

                // Die beiden dati werden zu einem datum zusammengeführt
                $merge = new DateTime($postDate->format('Y-m-d') . ' ' . $postTime->format('H:i:s'));
                // Das datum wird zum korrekten format umgewandelt
                $date = $merge->format('Y-m-d H:i:s');
                $idOwner = $_SESSION["id"];
                // Schaut ob der namePlace gesetzt wurde, wenn ja wird dieser wert der Varibale zugeschrieben, sonst ist der wert null. (In der DB wird nicht null stehen)
                $namePlace = isset($_POST['namePlace']) ? $_POST['namePlace'] : "null";
                $street = $_POST['street'];
                // Schaut ob die streetNbr gesetzt wurde, wenn ja wird dieser wert der Varibale zugeschrieben, sonst ist der wert null. (In der DB wird nicht null stehen)
                $streetNbr = isset($_POST['streetNbr']) ? $_POST['streetNbr'] : "null";
                $place = $_POST['place'];
                $plz = $_POST['plz'];

                $eventsRepository = new EventsRepository();

                // Es wird eine adresse erstellt. Falls diese bereits existiert wird einfach dessen id zurück gegeben, falls nicht die id der neu erstellten adresse
                $adressId = $eventsRepository->createAdress($namePlace, $street, $streetNbr, $place, $plz);
                // Das event wird erstellt
                $newEventId = $eventsRepository->create($title, $description, $date, $idOwner, $adressId);
                // Die references in der zwischentabelle werden eingeschrieben
                $eventsRepository->createJoin($idOwner, $newEventId);
            }

            header('Location: /events/user');
        } else header('Location: /user/login');
    }

    public function update()
    {
        $authentication = new Authentication();

        // Wenn keine session gestarte ist wird eine gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Wenn der Benutzer angemeldet ist, kann er die bearbeitungsseite aufrufen
        if ($authentication->isAuthenticated()) {
            $eventsRepository = new EventsRepository();

            $view = new View('events/update');
            $view->heading = "Event ändern";
            $view->title = "Update Event";
            $view->event = $eventsRepository->readByIdByAddressJoin($_GET["id"]);
            $view->display();
        } else header('Location: /user/login');
    }

    public function doUpdate()
    {
        $authentication = new Authentication();

        // Wenn keine session gestarte ist wird eine gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Wenn der Benutzer angemeldet ist, kann er events updaten
        if ($authentication->isAuthenticated()) {
            if (isset($_POST['send'])) {
                $validator = new Validator();
                // Die daten werden entschärft
                $validator->sanitizeData();

                $title = $_POST['title'];
                $description = $_POST['description'];

                // Die beiden Dati werden von strings zu dati geändert
                $postDate = new DateTime($_POST['date']);
                $postTime = new DateTime($_POST['time']);

                // Die beiden dati werden zu einem datum zusammengeführt
                $merge = new DateTime($postDate->format('Y-m-d') . ' ' . $postTime->format('H:i:s'));
                // Das datum wird zum korrekten format umgewandelt
                $date = $merge->format('Y-m-d H:i:s');
                // Schaut ob der namePlace gesetzt wurde, wenn ja wird dieser wert der Varibale zugeschrieben, sonst ist der wert null. (In der DB wird nicht null stehen)
                $namePlace = isset($_POST['namePlace']) ? $_POST['namePlace'] : "null";
                $street = $_POST['street'];
                // Schaut ob die streetNbr gesetzt wurde, wenn ja wird dieser wert der Varibale zugeschrieben, sonst ist der wert null. (In der DB wird nicht null stehen)
                $streetNbr = isset($_POST['streetNbr']) ? $_POST['streetNbr'] : "null";
                $place = $_POST['place'];
                $plz = $_POST['plz'];
                $id = $_GET["id"];

                $eventsRepository = new EventsRepository();

                // Es wird eine adresse erstellt. Falls diese bereits existiert wird einfach dessen id zurück gegeben, falls nicht die id der neu erstellten adresse. Die Adresse soll hier nicht upgedated werden, da diese ja wieder verwendent werden könnte
                $adressId = $eventsRepository->createAdress($namePlace, $street, $streetNbr, $place, $plz);
                // Das event wird geupdatet
                $eventsRepository->update($title, $description, $date, $id, $adressId);
            }

            header('Location: /events/user');
        } else header('Location: /user/login');
    }

    public function delete()
    {
        $authentication = new Authentication();

        // Wenn keine session gestarte ist wird eine gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Wenn der Benutzer angemeldet ist, kann er events löschen
        if ($authentication->isAuthenticated()) {
            $id = $_GET["id"];

            $eventsRepository = new EventsRepository();
            // Das event wird gelöscht
            $eventsRepository->deleteById($id);

            header('Location: /events/user');
        } else header('Location: /user/login');
    }
}
