<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDo App</title>
</head>
<body>
  <?php
    require_once('./api/user.php');

    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
      $uri = 'https://';
    } else {
      $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];

    user_authenticate();
  ?>
</body>
</html>