<?php
  require_once('home-ctrl.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDo App</title>
</head>
<body>
  <main>
    <header>
      <h1>ToDo App</h1>
      <form method="post">
        <label>
          <?php echo $userData->userName ?>
        </label>
        <input type="submit" name="logout" value="Logout" />
      <form method="post">
    </header>
    <section>
      <h1><?php
        if ($userData->firstName !== null) {
          echo $userData->firstName;
          if ($userData->lastName !== null) {
            echo " $userData->lastName";
          }
          echo "'s ";
        } else {
          echo "My ";
        }
      ?>
        ToDo lists
      </h1>
      <article className="todo_card">
        <h1>Todo Title Here<h1>
        <span>#/#<span>
        <p>Todo Description here</p>
      </article>
    </section>
  </main>
</body>
</html>