<?php
session_start();

$page = $_GET['page'] ?? '';

require_once __DIR__.'/auth/db_connect.php';
require_once __DIR__.'/auth/functions.php';

require_once __DIR__.'/layouts/header.php';

if(isset($_SESSION['msg'])) unset($_SESSION['msg']);

$templateFile =  __DIR__.'/views/'   .$page.    '.view.php';

if(file_exists($templateFile)) {
  require_once $templateFile;
}
else {
  require_once __DIR__.'/views/index.view.php';
}

require_once __DIR__.'/layouts/footer.php';

