<?php
// use https://www.srihash.org/ to generate integrity hashes


class Page {
  public function __construct($title, $headerContent = "", $bodyContent = "", $footerContent = "", $style = "") {
    $stylesheet = "";
    $cssCachBuster = "ver=1";
    if ($style !== "") $stylesheet = "<link rel=\"stylesheet\" href=\"/todoapp/styles/$style?$cssCachBuster\">";
    $year = date("Y");
    $footerMarkup = "";
    if ($footerContent !== null && $footerContent !== "") {
      $footerMarkup = <<<XML
        <div class="footer__content">
          $footerContent
        </div>
      XML;
    }
    echo <<<XML
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Create all the ToDo lists you need! Have one for groceries, shopping etc.. Easily add ToDo items and check them off when you're done!">
        <title>ToDo App - $title</title>
        <link rel="stylesheet" href="/todoapp/styles/theme.css?$cssCachBuster">
        $stylesheet
        <link
          integrity="sha384-QyOIuAdNFUvnfP6FGfqShjmsibA4Sbvg0dd5LqjC40PJXlPjHjuGkDO3ySgKz95K"
          crossorigin="anonymous"
          href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap"
          rel="stylesheet"
        >
      </head>
      <body>
        <header class="header">
          <div class="container">
            <section class="header__title">
              <h1><a class="home-link" title="ToDo App home page" href="/todoapp/index.php">ToDo App</a></h1>
            </section>
            <section class="header__content">
              $headerContent
            </section>
          </div>
        </header>
        <main class="main">
          <div class="container">
            <h1 class="main__header">$title</h1>
            $bodyContent
          <div>
        </main>
        <footer class="footer">
          <div class="container">
            $footerMarkup
            <div class="footer__copyright">
              © $year StJohn3D™ All Rights Reserved
            </div>
          <div>
        </footer>
      </body>
      </html>
    XML;
  }
}

?>