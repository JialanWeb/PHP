<?php 

function e($value) {
  return htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}
#------------------------------------------------------------------


function pageTitle() {
  global $page;
  $title = '';
  switch($page) {
    case 'about' : $title =  ' - Über uns'; break;
    case 'empfehlungen' : $title = ' - Empfehlungen'; break;
    case 'Diskussion' : $title = ' - Mitglieder'; break;
    default : $title = ' - Startseite'; break;
  }
  return $title;
}

function csrf_token() {
  $csrfToken = bin2hex(random_bytes(64));
  if( !isset($_SESSION['token']) || empty($_SESSION['token'])) {
    $_SESSION['token'] = $csrfToken;
  }
  return $_SESSION['token'];
}


function userIstLogged() {
  if(    (!isset($_SESSION['id']) && !isset($_SESSION['loggedIn']))  || empty($_SESSION['id'])     ) {
    http_response_code(403);
    echo '<p class="fs-2 text-light fw-bold p-2">Bitte sich anmelden oder registrieren</p>';
    die();
  }
}