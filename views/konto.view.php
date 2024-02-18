<?php

userIstLogged();

$stmt = $db->prepare('SELECT * FROM `users` WHERE `id` = :id');
$stmt->bindValue(':id', $_SESSION['id']);
$stmt->execute();
$result = $stmt->fetch();
?>


<div class="custom-container">
    <div class="row m-2 p-2">
        <div class="col-md-6 card bg-warning bg-opacity-25 p-2 rounded">
            <div class="card-header text-center">
                <h3>Persönliche Daten</h3>
                <p>Hier Kannst du deine persönlichen Daten, E-Mail-Adresse und Passwort einsehen und ändern.</p>
            </div>
            <div class="card-body">
              <div class="container text-center"><img src="./img/<?= $result['portrait']?>" alt="portrait" class="img-fluid p-2" /></div>
              <p><strong>Name:</strong> <?=$result['vorname'].' '.$result['nachname']?></p>
              <p><strong>Geburtstag:</strong> <?=$result['birthday']?></p>
              <p><strong>Summe der besuchten Länder:</strong> <?=$result['countries_number']?></p>
              <p><strong>Besuchte Länder:</strong> <?=$result['footprint']?></p>
            </div>
            <div class="card-footer text-center">
                <a href="?page=konto&update&csrf=<?= csrf_token();?>&#change" class="btn btn-primary fw-bold m-1">Profil bearbeiten</a>    
                <a href="?page=konto&pwd&csrf=<?= csrf_token();?>&#changepwd" class="btn btn-warning fw-bold m-1">Passwort ändern</a>
                <a href="?page=konto&del&csrf=<?= csrf_token();?>&#clear" class="btn btn-danger fw-bold m-1">Konto löschen</a>
            </div>
        </div>
        <div class="col-md-6 bg-success bg-opacity-25 p-2 rounded">
            <div class="card-header text-center">
                <h3>Meine Erfahrungen </h3>
                <p>Hier kannst du die Erfahrungen einsehen, die du in diesem Forum geteilt hast.</p>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h4><strong><?=$result['title']?></strong></h4>
                    </div>
                    <div class="card-body">
                       <p><?=$result['info']?></p>
                    </div>
                </div> 
            </div>
            <div class="card-footer  text-center">
                 <a href="?page=konto&comment&csrf=<?= csrf_token();?>&#comment" class="btn btn-primary fw-bold m-1">Kommentare Anzeigen</a>
            </div>
        </div>
    </div>
</div>

<!----------------------Komentare anzeigen---------------------------->
<?php if($_SERVER["REQUEST_METHOD"] == "GET" && 
        isset($_GET['comment']) && 
        $_GET['csrf'] === $_SESSION['token']):

$stmtPost = $db->prepare('SELECT * FROM `posts` WHERE `user_id` = :id');
$stmtPost->bindValue(':id', $_SESSION['id']);
$stmtPost->execute();
$results = $stmtPost->fetchAll();
?>
<div class="col-12 p-2 bg-success bg-opacity-50" id="comment">
  <?php foreach($results AS $result):?>
  <ul class="list-group my-1">
     <li class="list-group-item">
        <div class="card">
           <div class="card-body">
             <?=$result['comment']?>
           </div> 
           <div class="card-footer">
              <p class="text-right"><small><i>Geschriben am: <?=$result['created_at']?></i></small><p>
           </div>
        </div> 
     </li>
  </ul>
  <?php endforeach;?>
</div>
<?php endif;?>
<!----------------------Passwort ändern---------------------------->
<?php if($_SERVER["REQUEST_METHOD"] == "GET" && 
        isset($_GET['pwd']) && 
        $_GET['csrf'] === $_SESSION['token']):
?>
<div class="col-12 p-2" id="changepwd">
<form action="./auth/user/pwdUpdate.php" method="POST" class="row bg-warning bg-opacity-50 px-3 mx-2">
  <div class="p-1 fs-3 fw-bold">Mein Passwort ändern</div>
  <div class="p-1">
    <label for="pwd">Akutuelles passwort</label>
    <input type="password" class="form-control" name="pwd" id="pwd">
  </div>
  <div class="p-1">
    <label for="pwd_new">Neues passwort</label>
    <input type="password" class="form-control" name="pwd_new" id="pwd_new">
  </div>
  <div class="p-1">
  <label for="pwd_repeat">Neues passwort bestätigen</label>
    <input type="password" class="form-control" name="pwd_repeat" id="pwd_repeat">
  </div>
  <div class="p-1">
    <button type="submit" 
            class="btn btn-warning btn-lg">Speichern</button>
  </div>
  <input type="hidden" name="csrf_token" value="<?= csrf_token();?>" />
</form>
</div>
<?php endif;?>
<!----------------------Profile bearbeiten------------------------>
<?php if($_SERVER["REQUEST_METHOD"] == "GET" && 
        isset($_GET['update']) && 
        $_GET['csrf'] === $_SESSION['token']):
?>
<div class="col-12 p-2" id="change">
<form action="./auth/user/update.php" method="POST" class="row bg-primary bg-opacity-50 px-3 mx-2" enctype="multipart/form-data">
  <div class="p-1 fs-3 fw-bold">Hier können Sie dein Kontodaten verändern.</div>
  <div class="p-1">
    <label for="vorname">Dein Vorname:</label>
    <input type="text" class="form-control" name="vorname" id="vorname" value="<?=$result['vorname']?>">
  </div>
  <div class="p-1">
    <label for="nachname">Dein Nachname:</label>
    <input type="text" class="form-control" name="nachname" id="nachname" value="<?=$result['nachname']?>">
  </div>
  <div class="p-1">
    <label for="birthday">Dein Geburtstag:</label>
    <input type="date" id="birthday" name="birthday" value="<?=$result['birthday']?>">
  </div>
  <div class="p-1">
      <label for="quantity">Wie viele Länder haben Sie bisher bereist?</label>
      <input type="number" id="quantity" name="quantity" min="1" max="200" value="<?=$result['countries_number']?>">
  </div>
  <div class="p-1">
      <label for="countries">Kannst du einige der Länder nennen, die Sie besucht haben?</label>
      <input type="text" id="countries" name="countries" class="form-control" value="<?=$result['footprint']?>" >
  </div>
  <div class="p-1">
    <label for="portrait">Bitte lade hier dein neues Profilbild hoch.</label>
    <input type="file" name="portrait" class="form-control my-1" id="portrait">
  </div>

  <input type="hidden" name="token" value="<?= csrf_token();?>" />
  <div class="p-1">
      <button type="submit" class="btn btn-success btn-lg">Aktualiesirung</button>
  </div>
</form>
</div>
<?php endif;?>
<!----------------------Profile löschen--------------------------->
<?php if($_SERVER["REQUEST_METHOD"] == "GET" && 
        isset($_GET['del']) && 
        $_GET['csrf'] === $_SESSION['token']):
?>
<div class="col-12 p-2" id="clear">
<form action="./auth/user/delete.php" method="POST" class="row bg-danger bg-opacity-50 px-3 mx-2">
  <div class="p-1 fs-3 fw-bold">Dein passwort zwei mal eingeben, dann Konto wurde gelöscht.</div>
  <div class="p-1">
    <label for="pwd">Dein passwort</label>
    <input type="password" class="form-control" name="pwd" id="pwd">
  </div>
  <div class="p-1">
  <label for="pwd_repeat">Passwort bestätigen</label>
    <input type="password" class="form-control" name="pwd_repeat" id="pwd_repeat">
  </div>
  <div class="p-1">
    <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Willst Du wirklich alle deine Daten und Profil löschen?');">Speichern</button>
  </div>
  <input type="hidden" name="csrf_token" value="<?= csrf_token();?>" />
</form>
</div>
<?php endif;?>