<div class="column pt-3 pb-3">
</div>

<div class="row pb-3 h-100 border-top">
    <div class="col h-100"></div>
    <div class="col-10 h-100">
        <div class="row h-100">
            <div class="col-3 h-100">
                <!-- Side Nav -->
                <div class="sidenav border-right h-100 w-100">
                    <a href="/user/profile" class="btn-block indigo text-white text-center text-nowrap pt-3 pb-3 mr-auto ml-auto mt-3 w-75" role="button">Event Kalender</a>
                    <a href="/user/profile" class="btn-block indigo text-white text-center text-nowrap pt-3 pb-3 mr-auto ml-auto w-75" role="button">Einladungen</a>
                    <a href="/user/profile" class="btn-block indigo text-white text-center text-nowrap pt-3 pb-3 mr-auto ml-auto mb-3 w-75" role="button">Profil</a>
                </div>
            </div>
            <div class="col-9 mt-3">
                <h2>Nutzerdaten</h2>
                <p class="font-weight-bold w-100 column d-flex text-nowrap">Nachname: <span class="font-weight-normal text-right w-100 justify-content-end"><?=$_SESSION['name'];?></span></p>
                <p class="font-weight-bold w-100 column d-flex text-nowrap">Vorname: <span class="font-weight-normal text-right w-100 justify-content-end"><?=$_SESSION['firstname'];?></span></p>
                <p class="font-weight-bold w-100 column d-flex text-nowrap">E-Mail: <span class="font-weight-normal text-right w-100 justify-content-end"><?=$_SESSION['email'];?></span></p>
                <button class="btn indigo text-white ml-0 w-100" type='button' name='send' data-toggle="modal" data-target="#changeCredentials">Ändern</button>
            </div>
        </div>
    </div>
    <div class="col"></div>
</div>


<?php

use App\View\View;

$view = new View('user/changeCredentials');

$attributes = array("username" => htmlspecialchars($_SESSION["user"]), "firstname" => htmlspecialchars($_SESSION["firstname"]), "lastname" => htmlspecialchars($_SESSION["name"]), "email" => htmlspecialchars($_SESSION["email"]));

$view->attributes = $attributes;

$view->displaySection();
?>