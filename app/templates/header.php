<?php

use App\Authentication\Authentication;

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$authenticator = new Authentication();

$isLoggedIn = $authenticator->isAuthenticated();
$isLoggedIn ? $username = $_SESSION['user'] : $username = "";
?>
<!doctype html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="text/stylesheet" href="./css/style.css">

  <!-- Bootstrap CSS -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <title><?= $title; ?> | Event Händler</title>

</head>

<body>
  <!-- Navbar -->
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark indigo">
    <a class="navbar-brand" href="/">Event Händler</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle waves-effect waves-light pr-5 pl-5" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>
          <div class="dropdown-menu dropdown-info" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item waves-effect waves-light" href="/">Startseite</a>
            <a class="dropdown-item waves-effect waves-light" href="/information/about">About</a>
            <a class="dropdown-item waves-effect waves-light" href="/information/contact">Kontakt</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle waves-effect waves-light pr-5 pl-5" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
          <div class="dropdown-menu dropdown-info" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item waves-effect waves-light" href="/events">Alle Events</a>
            <a class="dropdown-item waves-effect waves-light" href="/events/user">Meine Events</a>
          </div>
        </li>
      </ul>
    </div>
    <?php if ($isLoggedIn) : ?>
      <div>
        <ul class="navbar-nav mr-5">
          <li class="nav-item dropdown text-right">
            <a class="nav-link dropdown-toggle waves-effect waves-light pr-5 pl-5" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $username ?></a>
            <div class="dropdown-menu dropdown-info text-left" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item waves-effect waves-light" href="/user/profile">Profil</a>
              <a class="dropdown-item waves-effect waves-light" href="/user/profile">Benutzerdaten ändern</a>
              <a class="dropdown-item waves-effect waves-light" href="/user/logout">Ausloggen</a>
            </div>
          </li>
        </ul>
      </div>
    <?php else : ?>
      <div>
        <ul class="navbar-nav">
          <li class="nav-item dropdown text-right">
            <a class="nav-link dropdown-toggle waves-effect waves-light pr-5 pl-5" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</a>
            <div class="dropdown-menu dropdown-info" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item waves-effect waves-light" href="/user/login">Login</a>
              <a class="dropdown-item waves-effect waves-light" href="/user/register">Registrieren</a>
            </div>
          </li>
        </ul>
      </div>
    <?php endif ?>
  </nav>
  <!-- Navbar end -->
  <main class="container">
    <h1 class="text-center mt-3"><?= $heading; ?></h1>