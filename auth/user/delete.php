<?php
session_start();

require_once dirname(__DIR__,2).'/auth/db_connect.php';
require_once dirname(__DIR__,2).'/auth/functions.php';

userIstLogged();

$pwd = '';
if(isset($_POST['pwd'])) $pwd = (string) $_POST['pwd'];

$pwd_repeat = '';
if(isset($_POST['pwd_repeat'])) $pwd_repeat = (string) $_POST['pwd_repeat'];

$token = '';
if(isset($_POST['csrf_token'])) $token = (string) $_POST['csrf_token'];

#++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if( !empty($pwd) && !empty($pwd_repeat)) {
  #-----------------------
  $stmt = $db->prepare('SELECT * FROM `users` WHERE `id` = :id');
  $stmt->bindValue(':id', $_SESSION['id']);
  $stmt->execute();
  $result = $stmt->fetch();
  #-----------------------
  if(password_verify($pwd, $result['password']) && $pwd === $pwd_repeat && $_POST['csrf_token'] === $_SESSION['token']) {
    $stmt = $db->prepare('DELETE FROM `users` WHERE `id` = :id');
    $stmt->bindValue(':id', $_SESSION['id']);
    $stmt->execute();

    $_SESSION['msg'] = "Profil wurde gelöscht";
    unset($_SESSION['vorname']);
    unset($_SESSION['id']);
    unset($_SESSION['loggedIn']);
    unset($_SESSION['token']);
    session_regenerate_id(true);
  } else {
    $_SESSION['msg'] = "Falsche Eingaben";
  }
}
else {
  $_SESSION['msg'] = "Bitte Passwort eingeben und bestätigen";
}
$page = 'page=konto&del&csrf='.csrf_token();
header('Location:../../?'.$page);