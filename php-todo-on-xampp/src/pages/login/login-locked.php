<?php
  require_once('./components/Page.php');
  require_once('loginHeader.php');

  $bodyContent = <<<XML
    <p>Too many failed login attempts. Please try again later.</p>
    <a href="#NOT-YET-IMPLEMENTED">I forgot my password</a>
  XML;

  new Page("Login", $loginHeader, $bodyContent);
?>