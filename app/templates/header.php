<!doctype html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">

  <title><?= $title; ?> | Event Händler</title>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-md fixed-top navbar-dark unique-color">
      <a class="navbar-brand" href="/">Event Händler</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>
            <div class="dropdown-menu dropdown-info" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item waves-effect waves-light" href="/start">Startseite</a>
              <a class="dropdown-item waves-effect waves-light" href="/about">About</a>
              <a class="dropdown-item waves-effect waves-light" href="/contact">Kontakt</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events</a>
            <div class="dropdown-menu dropdown-info" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item waves-effect waves-light" href="/events">Alle Events</a>
              <a class="dropdown-item waves-effect waves-light" href="/events/user">Meine Events</a>
            </div>
          </li>
        </ul>
      </div>
      <div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown text-right">
            <a class="nav-link dropdown-toggle waves-effect waves-light " id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Benutzername</a>
            <div class="dropdown-menu dropdown-info" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item waves-effect waves-light" href="/user/home">Benutzer Menu</a>
              <a class="dropdown-item waves-effect waves-light" href="/user/changepassword">Passwort ändern</a>
              <a class="dropdown-item waves-effect waves-light" href="">Ausloggen</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <div class="container">

  <h1 class="text-center"><?= $heading; ?></h1>