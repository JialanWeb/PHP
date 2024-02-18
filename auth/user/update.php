<?php
session_start();

require_once dirname(__DIR__,2).'/auth/db_connect.php';
require_once dirname(__DIR__,2).'/auth/functions.php';

if(!empty($_POST)) {
    $vorname = '';
    if(isset($_POST['vorname'])) $vorname = (string) $_POST['vorname'];
    $nachname = '';
    if(isset($_POST['nachname'])) $nachname = (string) $_POST['nachname'];
    $birthday = '';
    if(isset($_POST['birthday'])) $birthday = (string) $_POST['birthday'];
    $quantatity = 0;
    if(isset($_POST['quantatity'])) $quantatity= (int) $_POST['quantatity'];
    $countries = '';
    if(isset($_POST['countries'])) $countries = (string) $_POST['countries'];
    $token = '';
    if(isset($_POST['token'])) $token = (string) $_POST['token'];

    if(isset($_FILES['portrait']['name'])) {
        $picName = $_FILES['portrait']['name']; 
        $picSize = $_FILES['portrait']['size'];
        $picTmp = $_FILES['portrait']['tmp_name'];
        $picError = $_FILES['portrait']['error'];
        if($picError === 0) {
            $picInfo = pathinfo($picName, PATHINFO_EXTENSION);
            $types = ['jpg', 'jpeg', 'png', 'gif'];
            if( !in_array(strtolower($picInfo), $types) ) {
                $_SESSION['msg'] = 'Datei muss nur vom Typ "jpg, png, gif" sein';
            } else {
                $newImageName = $_SESSION['id'].'-'.$vorname.'-'.$nachname.'.'.strtolower($picInfo) ;
                move_uploaded_file($picTmp, dirname(__DIR__,2).'/upload/'. $newImageName);
            }
        } else {
        echo 'Fehler';
        }#upload failure
    }#ende if isset

    if(!empty($vorname) && !empty($nachname) && $token === $_SESSION['token']) {
        $stmt = $db->prepare('UPDATE `users` SET `vorname` = :vorname, `nachname` = :nachname, `birthday` = :birthday, `countries_number` = :quantity, `footprint` = :countries, `portrait` = :portrait,`updated_at` = NOW() WHERE `id` = :id');
        $stmt->bindValue(':vorname', $vorname);
        $stmt->bindValue(':nachname', $nachname);
        $stmt->bindValue(':birthday', $birthday);
        $stmt->bindValue(':quantity', $quantity);
        $stmt->bindValue(':countries', $countries);
        $stmt->bindValue(':portrait', $newImageName ?? 'dummy.jpg');
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
        $_SESSION['vorname'] = $vorname;
        $_SESSION['msg'] = 'Deine Daten wurden aktualisiert.!';
    } else {
        $_SESSION['msg'] = 'Alle Felder sind Pflichtfelder (dürfen nicht leer sein!)';
    }
}

header('Location:../../index.php?page=konto');
