<?php 

session_start();

require_once dirname(__DIR__,2).'/auth/db_connect.php';
require_once dirname(__DIR__,2).'/auth/functions.php';


if(!empty($_POST)) {
  $comment = '';
  if(isset($_POST['comment']))    $titel = (string) $_POST['comment'];
  $id = 0;
  if(isset($_POST['commentid']))   $id = (int) $_POST['commentid'];

  if(!empty($_SESSION['id']) && !empty($comment)) {
    $stmt = $db->prepare('INSERT INTO `posts` (`user_id`,`comment`,`parent_id`)
                                        VALUES(:uid, :comment, :id)  ');
    $stmt->bindValue('uid', $_SESSION['id']);
    $stmt->bindValue('comment', $comment);
    $stmt->bindValue('id', $id);
    $stmt->execute();
    $_SESSION['msg'] = 'Eintrag wurde eingefügt.';
  } else {
    $_SESSION['msg'] = 'Alle Felder müssen ausgefüllt sein.';
  }

}
header('Location: ../../index.php?page=diskussion');
