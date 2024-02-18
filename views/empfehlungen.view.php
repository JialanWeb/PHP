<?php

$stmt = $db->prepare('SELECT * FROM `users`');
$stmt->execute();
$posts = $stmt->fetchAll();
?>

<?php foreach($posts AS $post):?>
<div>
<div class="col-md-10 card bg-warning bg-opacity-25 p-2 rounded m-2 mx-auto">
     <div class="card-header text-center">
         <h2><?=$post['title']?></h2>
     </div>
     <div class="card-body text-left">
         <p><?=$post['info']?></p>
     </div>
     <div class="card-footer text-center">
         <p><em><small>Geschriben von:</small></em> <strong><?=$post['vorname']. ' ' . $post['nachname']?></strong><br><em><small> Am: <?=$post['created_at']?></small></em></p>
     </div>
</div>
</div>
<?php endforeach;?>