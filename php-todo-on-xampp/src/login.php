<?php
  require_once('./api/secure.php');
  force_https_on_prod();
  require_once('./pages/login/login-route.php');
?>