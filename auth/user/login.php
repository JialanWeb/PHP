<?php
session_start();

require_once dirname(__DIR__,2).'/auth/db_connect.php';
require_once dirname(__DIR__,2).'/auth/functions.php';

if(!empty($_POST)){
    $email = '';
    if(isset($_POST['email'])) $email = (string) $_POST['email'];
    $password = '';
    if(isset($_POST['password'])) $password = (string) $_POST['password'];
    $csrf='';
    if(isset($_POST['csrf_token']))  $csrf = (string) $_POST['csrf_token'];

    if(!empty($email) && !empty($password)) {
        $stmt=$db->prepare('SELECT * From `users` WHERE `email` = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute(); 
        $result = $stmt->fetch();
        
        if($result && password_verify($password, $result['password']) && $csrf===$_SESSION['token']) {
            $_SESSION['vorname'] = $result['vorname'];
            $_SESSION['id'] = $result['id'];
            $_SESSION['loggedIn'] = true;

            $_SESSION['msg'] = 'Hallo '.$result['vorname'].'! Willkommen im Tourismus-Forum Freiburg!';
            unset($_SESSION['token']);
        } else {
            $_SESSION['msg'] = 'Sie haben falsche Logindaten eingegeben.';
        }

    } else {
        $_SESSION['msg'] = 'Felder dürfen nicht leer sein';
    }
}

header('Location:../../index.php');