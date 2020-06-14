<?php
  require_once('create-ctrl.php');
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
      <h1>Create new ToDo list</h1>
      <form method="post" action="create.php">
        <div class="form-control">
          <label for="title">Title<?php
            if(!$titleState->valid) { echo ": <b>$titleState->errorMessage</b>"; }
          ?></label>
          <input type="text" name="title" id="title"
            required aria-required="true" minlength="4" maxlength="55"
            value="<?php echo $title; ?>"
          />
        </div>
        <div class="form-control">
          <label for="description">Description<?php
            if(!$descriptionState->valid) { echo ": <b>$descriptionState->errorMessage</b>"; }
          ?></label>
          <textarea name="description" id="description"
            aria-required="false" maxlength="256"
          />
            <?php echo $description; ?>
          </textarea>
        </div>
        <a href="/todoapp/index.php?">Cancel</a>
        <input type="submit" name="submit" value="Create"/>
      </form>
    </section>
  </main>
</body>
</html>