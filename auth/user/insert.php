<?php
session_start();

require_once dirname(__DIR__,2).'/auth/db_connect.php';
require_once dirname(__DIR__,2).'/auth/functions.php';

if(!empty($_POST)) {
  $email = '';
  if(isset($_POST['email'])) $email = (string) $_POST['email'];
  $pwd = '';
  if(isset($_POST['pwd'])) $pwd = (string) $_POST['pwd'];
  $vorname = '';
  if(isset($_POST['vorname'])) $vorname = (string) $_POST['vorname'];
  $nachname = '';
  if(isset($_POST['nachname'])) $nachname = (string) $_POST['nachname'];
  $birthday = '';
  if(isset($_POST['birthday'])) $birthday = (string) $_POST['birthday'];
  $quantity = 0;
  if(isset($_POST['quantity'])) $quantity = (int) $_POST['quantity'];
  $countries = '';
  if(isset($_POST['countries'])) $countries = (string) $_POST['countries'];
  #---------------------------------------------------------
  if(!empty($email) && !empty($pwd) && !empty($vorname) && !empty($nachname)) {
    $stmt = $db->prepare('SELECT `email` FROM `users` WHERE `email` = :email');
    $stmt->bindValue('email', $email);
    $stmt->execute();
    $result = $stmt->fetch();    
    #------------------------
    if(!empty($result['email'])) {
      $_SESSION['msg'] = 'E-Mail existiert schon!';
    }else {
      $stmt = $db->prepare( 'INSERT INTO `users` (`nachname`,`vorname`,`email`,`password`,`birthday`, `countries_number`, `footprint`) 
                                        VALUES(:nachname, :vorname, :email, :pwd, :birthday, :quantity, :countries)' );
      $stmt->bindValue('nachname', $nachname);
      $stmt->bindValue('vorname', $vorname);
      $stmt->bindValue('email', $email);
      $stmt->bindValue('pwd', password_hash($pwd, PASSWORD_DEFAULT));
      $stmt->bindValue('birthday', $birthday);
      $stmt->bindValue('quantity', $quantity);
      $stmt->bindValue('countries', $countries);
      $stmt->execute();
      $_SESSION['msg'] = 'Hallo '. mb_strtoupper($vorname) . ', Sie sind schon erfolgreich registriert<br />Sie können sich jetzt einloggen!';
    }
    #------------------------
  } else {
    $_SESSION['msg'] = 'Pflichtfelder dürfen nicht leer sein!';
  }
  #---------------------------------------------------------
}

header('Location:../../index.php?page=register');
