<div class="col-12 container">
<h3 class="display-5 text-center">Kommentare von den Reisender</h3>

<?php if((isset($_SESSION['id']) && isset($_SESSION['loggedIn'])) || !empty($_SESSION['id'])): ?> 
<form action="auth/comments/insert.php" method="POST" class="rounded-1 p-2 bg-secondary bg-opacity-50">
<input type="text" name="comment" class="form-control my-1" placeholder="Bitte hinterlassen Sie hier Ihre Ansichten zum Reisen." />
<button type="submit" class="btn btn-success btn-lg">Submit</button>
</form>

<?php else: ?> 
   <div class="bg-secondary bg-opacity-50 text-center">
      <p>Bitte logg dich ein, dann kannst du auch wieder deine Reiseerfahrungen teilen..</p>
    </div>  
<?php endif; ?>
<!-----------make the page number---------------------------->
<?php
$anzahl = $db->prepare('SELECT count(id) AS `anzahlDatensatz` FROM `posts` WHERE `parent_id` = 0 ');
$anzahl->execute();
$resultAnzahl = $anzahl->fetch()['anzahlDatensatz'];
$pro_seite = 3;
$anzahlSeiten = ceil($resultAnzahl / $pro_seite);
$aktSeite = 1;
if(isset($_GET['seite'])) {
  $aktSeite = (int) $_GET['seite'];
  if($aktSeite <= 0 || $aktSeite > $anzahlSeiten) {
    $aktSeite = 1;
  }
}
?>
<!--------- get all the main comments, `parent_id`= 0 ------------->
<?php
$stmt = $db->prepare('SELECT *, posts.created_at AS datum, posts.id AS postid 
    FROM `posts` INNER JOIN `users` ON posts.user_id = users.id WHERE `parent_id`= 0
    ORDER BY `datum` ASC LIMIT :anfang, :proSeite');
$stmt->bindValue('anfang', ($aktSeite -1) * $pro_seite, PDO::PARAM_INT);
$stmt->bindValue('proSeite', $pro_seite, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll();

?>
<?php foreach($posts AS $post):
#-----------get the user name by connecting posts.user_id = users.id-------#
$stmt1 = $db->prepare('SELECT * FROM `users` WHERE `id` = :uid');
$stmt1->bindValue('uid', $post['user_id']);
$stmt1->execute();
$user = $stmt1->fetch();
?>

<div class="container m-2 center-div bg-secondary bg-opacity-25">
  <div class="row center-div my-5">
      <div class=" col-8 bg-success bg-opacity-50">
         <p><?=$post['comment']?></p>
      </div>
      <div class="col-4 bg-warning bg-opacity-50">
         <p><small><i>Geschriben von:<br></i></small> <?=$user['vorname'].' '.$user['nachname']?><br><small><i>Am:<br> <?=$user['created_at']?></i></small></p>
      </div>

<!------------ get all the replies accosicated with the main comments ------------>
<?php 
$stmt2 = $db->prepare('SELECT * FROM `posts` INNER JOIN `users` 
 ON posts.parent_id = :id WHERE posts.user_id = users.id');
$stmt2->bindValue('id', $post['postid']);
$stmt2->execute();
$replies = $stmt2->fetchAll();
?>
<?php if(!empty($replies)):?>
<?php foreach($replies AS $reply):
?>
      <div class="col-8 my-2 bg-success bg-opacity-25">
         <p><?= $reply['comment']?></p>
      </div>
      <div class="col-4 my-2 bg-warning bg-opacity-25">
      <p><small><i>Antwortet von:<br></i></small> <?= $reply['vorname'].' '.$reply['nachname']?>   <br><small><i>Am:<br> <?=$reply['created_at']?></i></small></p>
     </div>
<?php endforeach;?>
<?php endif;?>
<?php if((isset($_SESSION['id']) && isset($_SESSION['loggedIn'])) || !empty($_SESSION['id'])): ?> 
<form action="auth/comments/insert.php" method="POST" class="rounded-1 p-2 bg-secondary bg-opacity-25">
<input type="text" name="comment" class="form-control my-1" placeholder="Bitte hier antworten.." />
<button type="submit" class="btn btn-success btn-lg">Submit</button>
<input type="hidden" value="<?= $post['postid']?>" name="commentid" class="form-control">
</form>
<?php else: ?> 
   <div class="bg-secondary bg-opacity-50 text-center">
      <p>Bitte melde dich an, damit du auch unter diesen Kommentaren antworten kannst.</p>
    </div>  
<?php endif; ?>

</div>

</div>
<?php endforeach;?>

<!----------------------------------------------------------------------------->
<?php if($anzahlSeiten > 1):?>
  <nav class="my-2 p-0">
    <ul class="pagination">
      <?php for($i = 1; $i <= $anzahlSeiten; $i++):?>
        <li class="page-item <?= ($i === $aktSeite) ? 'active' : '' ?>">
          <a href="?page=diskussion&seite=<?= $i?>" class="page-link"><?= $i?></a>
        </li>
      <?php endfor;?>
    </ul>
  </nav>
<?php endif;?>