<?php
  require_once('./api/secure.php');
  force_https_on_prod();
  require_once('./api/User.php');
  $userData = User::authenticate();
  require_once('./pages/todo/todo-route.php');
?>