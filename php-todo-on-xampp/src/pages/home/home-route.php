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
      <span>
        UserName
      </span>
      <button>
        Logout
      </button>
    </header>
    <section>
      <h1>My ToDo lists</h1>
      <article className="todo_card">
        <h1>Todo Title Here<h1>
        <span>#/#<span>
        <p>Todo Description here</p>
      </article>
    </section>
  </main>
</body>
</html>