<?php

class Page {
  public function __construct($title, $headerContent = "", $bodyContent = "", $footerContent = "") {
    echo <<<XML
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ToDo App - $title</title>
      </head>
      <body>
        <header class="header">
          <section class="header__title">
            <h1>ToDo App</h1>
          </section>
          <section class="header__content">
            $headerContent
          </section>
        </header>
        <main>
          <h1>$title</h1>
          $bodyContent
        </main>
        <footer>
          $footerContent
        </footer>
      </body>
      </html>
    XML;
  }
}

?>