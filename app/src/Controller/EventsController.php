<?php

namespace App\Controller;

use App\Repository\EventsRepository;
use App\View\View;

class EventsController
{
    public function index()
    {
        $eventsRepository = new EventsRepository();

        $view = new View('events/index');
        $view->heading = "Events";
        $view->title = "Events";
        $view->events = $eventsRepository->readAll();
        $view->display();
    }
}
