<?php
  require_once('./components/Page.php');

  $bodyContent = <<<XML
    <h1>Well this is embarrassing...</h1>
    <section>
      <h1>We couldn't find the requested page.</h1>
      <p>Most likely the url is old or invalid.</p>
      <a href="/todoapp/index.php?">Please click here to go back to the Home page.</a>
    </section>
  XML;
  
  new Page("404", "", $bodyContent);
?>