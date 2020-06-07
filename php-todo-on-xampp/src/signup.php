<?php
  require_once('./api/secure.php');
  force_https_on_prod();
  require_once('./pages/signup/signup-route.php');
?>