<!DOCTYPE html>
<html lang="de"  class="homepage-bg">
<head>
	<meta charset="utf-8">
	<title>Tourismus-Forum Freiburg<?php echo pageTitle();?></title> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        @media screen and (max-width:930px){ 
        header+.navigation li{
            float:none;
        }
        }
    </style>
</head>
<body>
    <header>
    <h3><a href="index.php">Tourismus-Forum Freiburg</a></h3>
    </header> 

    <nav class="navigation bg-color">
        <ul class="clear show">
            <li>
                <a href="index.php" class="nav-link <?php echo empty($page) ? 'fw-bold bg-warning bg-opacity-25' : ''; ?>">Startseite</a>   
            </li>
            <li>
                <a href="index.php?page=empfehlungen" class="nav-link <?= ($page === 'empfehlungen') ? 'fw-bold bg-warning bg-opacity-25' : ''; ?>">Empfehlungen</a>
            </li>
            <li>
                <a href="index.php?page=diskussion" class="nav-link <?= ($page === 'diskussion') ? 'fw-bold bg-warning bg-opacity-25' : ''; ?>">Diskussion</a>
            </li>
          
            <?php if(!isset($_SESSION['id']) && !isset($_SESSION['loggedIn'])):?>
			<li class="nav-item">
				<a href="index.php?page=register" class="nav-link <?= ($page === 'register') ? 'fw-bold bg-warning bg-opacity-25' : ''; ?>">Register</a>
			</li>
			<li class="nav-item">
				<a href="index.php?page=login&#loginDaten" class="nav-link <?= ($page === 'login') ? 'fw-bold bg-warning bg-opacity-25' : ''; ?>">Login</a>
			</li>
			<?php else:?>
			<li class="nav-item">
				<a href="index.php?page=konto" class="nav-link <?= ($page === 'konto') ? 'fw-bold bg-warning bg-opacity-25' : ''; ?>">Konto</a>
			</li>
			<?php endif;?>  
            <li>
                <a href="index.php?page=impressum" class="nav-link <?= ($page === 'impressum') ? 'fw-bold bg-warning bg-opacity-25' : ''; ?>">Impressum</a>
            </li>
        </ul>
    </nav> 
<!-------------------Hier is Logout button when logged in------------------>
<?php if(isset($_SESSION['id']) && isset($_SESSION['loggedIn'])):?>
<div class="bg-secondary bg-opacity-25 warning-div">
	<span><strong>Hallo <?= $_SESSION['vorname']?></strong></span>
	<a href="auth/user/logout.php?csrf=<?= csrf_token()?>" class="btn btn-sm btn-warning transparent-btn fw-bold">Logout</a>
</div>
<?php endif;?>
<main>
<!---------- hier ist the msg related to datenbank ------>
<?php if(isset($_SESSION['msg'])): ?>
<div class="col-md-6 p-2 center-div">
    <p class="alert alert-primary text-center fw-bold"><?= nl2br($_SESSION['msg']) ?>
</div>
<?php endif;?>