<?php 

session_start();

$csrf = $_GET['csrf'];

if( $csrf === $_SESSION['token'] ) {

  unset($_SESSION['vorname']);
  unset($_SESSION['id']);
  unset($_SESSION['loggedIn']);

  $_SESSION['msg'] = 'Du hast schon abgemeldet';
} else {
  $_SESSION['msg'] = 'Fehler bei der Abmeldung';
}

unset($_SESSION['token']);

session_regenerate_id(true);

header('Location: ../../index.php');