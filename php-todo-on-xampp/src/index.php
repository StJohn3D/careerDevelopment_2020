<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDo App</title>
</head>
<body>
  <?php
    require_once('./api/secure.php');
    force_https_on_prod();
    require_once('./api/User.php');
    User::authenticate();
  ?>
</body>
</html>