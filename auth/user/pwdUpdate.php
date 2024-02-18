<?php
session_start();

require_once dirname(__DIR__,2).'/auth/db_connect.php';
require_once dirname(__DIR__,2).'/auth/functions.php';

userIstLogged(); 

$pwd = '';
if(isset($_POST['pwd'])) $pwd = (string) $_POST['pwd'];

$pwd_new = '';
if(isset($_POST['pwd_new'])) $pwd_new = (string) $_POST['pwd_new'];

$pwd_repeat = '';
if(isset($_POST['pwd_repeat'])) $pwd_repeat = (string) $_POST['pwd_repeat'];
#++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if( empty($pwd) || empty($pwd_new) || empty($pwd_repeat)) {
  $_SESSION['msg'] = "Alle Felder sollten ausgefüllt werden.";
}
else if($pwd_new !== $pwd_repeat) {
  $_SESSION['msg'] = "Passwort und Passwort-Bestätigung stimmen nicht überein. Vergewissere dich, dass beide Felder identisch sind.";
}
else {
  #---------------------
  $stmt = $db->prepare('SELECT * FROM `users` WHERE `id` = :id');
  $stmt->bindValue(':id', $_SESSION['id']);
  $stmt->execute();
  $result = $stmt->fetch();
  #---------------------
  #wurde der User gefunden?
  if(!empty($result)) {
    if(password_verify($pwd, $result['password']) && $_POST['csrf_token'] === $_SESSION['token']) {

      $stmt = $db->prepare('UPDATE `users` SET `password` = :newPwd, `updated_at` = NOW() WHERE `id` = :id');
      $stmt->bindValue(':newPwd', password_hash($pwd_new, PASSWORD_DEFAULT));
      $stmt->bindValue(':id', $_SESSION['id']);
      $stmt->execute();
      unset($_SESSION['vorname']);
      unset($_SESSION['id']);
      unset($_SESSION['loggedIn']);
      unset($_SESSION['token']);
      session_regenerate_id(true);

      $_SESSION['msg'] = "Passwort wurde geändert<br />Bitte sich neu anmelden";
    } else {
      $_SESSION['msg'] = "Das aktuelle Passwort ist nicht korrekt";
    }
  } 
} 
$page = 'page=konto&pwd&csrf='.csrf_token();
header('Location:../../?'.$page);