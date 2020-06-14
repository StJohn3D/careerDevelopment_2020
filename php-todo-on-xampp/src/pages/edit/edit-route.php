<?php
  require_once('edit-ctrl.php');
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
    <h1>ToDo App</h1>
    <section>
      <h1>Edit</h1>
      <form method="post" action="create.php">
        <div class="form-control">
          <label for="todo_list_title">Title</label>
          <input type="text" name="todo_list_title" id="todo_list_title"
            required aria-required="true" minlength="4" maxlength="256"
            value="some title"
          />
          <input type="submit" name="delete-todo-list" value="Delete"/>
        </div>
        <div class="form-control">
          <label for="todo_list_description">Description</label>
          <input type="text" name="todo_list_description" id="todo_list_description"
            required aria-required="true" minlength="4" maxlength="256"
            value="bla bla"
          />
        </div>
        <a href="/todoapp/index.php?">Cancel</a>
        <input type="submit" name="submit" value="Save"/>
      </form>
    </section>
  </main>
</body>
</html>