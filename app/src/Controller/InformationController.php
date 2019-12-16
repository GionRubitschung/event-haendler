<?php

namespace App\Controller;

use App\View\View;

/**
 * Siehe Dokumentation im DefaultController.
 */
class InformationController
{
    /**
     * Show About Site as index
     */
    public function index(){
        $view = new View('information/about');
        $view->heading = 'About';
        $view->display();
    }

    /**
     * Show Impressum
     */
    public function impressum(){
        $view = new View('information/impressum');
        $view->heading = 'Impressum';
        $view->display();
    }

    /**
     * Show Impressum
    */
    public function contact(){
        $view = new View('information/contact');
        $view->heading = 'Kontakt';
        $view->display();
    }

    /**
     * Show Impressum
    */
    public function about(){
        $view = new View('information/about');
        $view->heading = 'About';
        $view->display();
    }
}