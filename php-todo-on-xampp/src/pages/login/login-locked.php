<?php
  require_once('./components/Page.php');
  require_once('loginHeader.php');

  $bodyContent = <<<XML
    <section class="locked-out">
      <p>
        <b>Too many failed login attempts.</b> Please try again later.
      </p>
    </section>
    <section class="cta">
      <a class="btn btn--primary" href="#NOT-YET-IMPLEMENTED">Reset Password</a>
    </section>
  XML;

  new Page("Login", $loginHeader, $bodyContent, null, "login.css");
?>