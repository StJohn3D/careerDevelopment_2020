<?php
  require_once('./components/Page.php');

  $bodyContent = <<<XML
    <section class="funny">
      <p class="funny__text">Well this is embarrassing...</p>
    </section>
    <article class="serious">
      <h1 class="serious__title">We couldn't find the requested page.</h1>
      <p class="serious__text">Most likely the url is old or invalid.</p>
      <a class="btn btn--primary serious__cta" title="Please click here to go back to the Home page." href="/todoapp/index.php?">Home</a>
    </article>
  XML;
  
  new Page("404", "", $bodyContent, null, "404.css");
?>