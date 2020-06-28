<?php
// use https://www.srihash.org/ to generate integrity hashes

header_remove("Server"); //This isn't working and neither does the 'Header unset Server' directive in the .htaccess file

class Page {
  public function __construct($title, $headerContent = "", $bodyContent = "", $footerContent = "", $style = "") {
    $stylesheet = "";
    if ($style !== "") $stylesheet = "<link rel=\"stylesheet\" href=\"/todoapp/styles/$style\">";
    echo <<<XML
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Create all the ToDo lists you need! Have one for groceries, shopping etc.. Easily add ToDo items and check them off when you're done!">
        <title>ToDo App - $title</title>
        <link rel="stylesheet" href="/todoapp/styles/theme.css">
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
          <section class="header__title">
            <h1>ToDo App</h1>
          </section>
          <section class="header__content">
            $headerContent
          </section>
        </header>
        <main class="main">
          <h1 class="main__header">$title</h1>
          $bodyContent
        </main>
        <footer class="footer">
          $footerContent
        </footer>
      </body>
      </html>
    XML;
  }
}

?>