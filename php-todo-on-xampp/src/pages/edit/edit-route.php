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
      <form method="post" action="<?php echo $formSubmitAddress; ?>">
        <div class="form-control">
          <label for="todo_list_title">Title</label>
          <input type="text" name="todo_list_title" id="todo_list_title"
            required aria-required="true" minlength="4" maxlength="256"
            value="<?php echo $todoListData->title; ?>"
          />
        </div>
        <div class="form-control">
          <label for="todo_list_description">Description</label>
          <input type="text" name="todo_list_description" id="todo_list_description"
            required aria-required="true" minlength="4" maxlength="256"
            value="<?php echo $todoListData->description; ?>"
          />
        </div>
        <a href="/todoapp/index.php?">Cancel</a>
        <input type="submit" name="submit" value="Save"/>
      </form>
    </section>
    <aside>
      <p>#/#</p>
      <form method="post" action="<?php echo $formSubmitAddress; ?>">
        <input type="submit" name="delete-prompt" value="Delete"/>
      </form>
    </aside>
    <form method="post" action="<?php echo $formSubmitAddress; ?>">
    <?php
      if (isset($_POST['delete-prompt'])) {
        echo <<<XML
          <div class="modal">
            <section class="modal__header">
              <h1>Warning</h1>
            </section>
            <section class="modal__body">
              <p>This is a destructive action and cannot be undone. </br> Are you sure you want to delete this ToDo list?</p>
            </section>
            <section class="modal__footer">
                <input type="submit" name="delete-cancel" value="No Cancel" />
                <input type="submit" name="delete-confirm" value="Yes Delete" />
            </section>
          </div>
        XML;
      }
    ?>
    </form>
  </main>
</body>
</html>