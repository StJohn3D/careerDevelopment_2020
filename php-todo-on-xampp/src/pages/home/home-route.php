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
      </form>
    </header>
    <section>
      <h1><?php echoHeaderTitle($userData) ?></h1>
      <a href="/todoapp/create.php">Create new ToDo list</a>
      <hr/>
      <?php
        foreach ($todoListData as $todoData) {
          echo <<<XML
          <article className="todo_card" style="border: 1px solid; padding: 16px;">
            <header>
              <h1>$todoData->title<h1>
              <aside>$todoData->numCompleted/$todoData->numTodos<aside>
            </header>
            <p>$todoData->description</p>
            <a href="/todoapp/edit.php?id=$todoData->id">Edit</a>
          </article>
        XML;
        }
      ?>
    </section>
  </main>
</body>
</html>