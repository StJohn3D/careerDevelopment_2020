<?php
require_once('./db/Todo.php');
require_once('./lib/fieldHelpers.php');
require_once('todo-formValidators.php');

class TodoItem_Edit {
  public static function render($todoData, $todoListId) {
    $title = getFieldValue('todo_title', $todoData->title);
    $description = getFieldValue('todo_description', $todoData->description);

    $dataDueDate = $todoData->dueDate;
    if ($dataDueDate !== null) {
      $dateTime = new DateTime($dataDueDate);
      $formatted = $dateTime->format('Y-m-d');
      $dataDueDate = $formatted;
    }
    $dueDate = getFieldValue('todo_due_date', $dataDueDate);

    $titleState = validateTodoTitle($title);
    $descriptionState = validateTodoDescription($description);
    $dueDateState = validateTodoDueDate($dueDate);

    $formIsValid =
      $titleState->valid &&
      $descriptionState->valid &&
      $dueDateState->valid
    ;

    if (isset($_POST['submit']) && $formIsValid) {
      if ($todoData->id === null) {
        $id = Todo::add($todoListId, $title, $description, $dueDate);
      } else {
        $success = Todo::edit($todoData->id, $title, $description, $dueDate);
      }

      header('Location: '.$uri."/todoapp/edit.php?id=$todoListId");
      exit;
    }

    $titleErrorMessage = $titleState->valid ? "" : <<<XML
      <b>$titleState->errorMessage</b>
    XML;

    $descriptionErrorMessage = $descriptionState->valid ? "" : <<<XML
      <b>$descriptionState->errorMessage</b>
    XML;

    $dueDateErrorMessage = $dueDateState->valid ? "" : <<<XML
      <b>$dueDateState->errorMessage</b>
    XML;

    return <<<XML
      <article className="todo_card" style="border: 1px solid; padding: 16px;">
        <form method="post">
          <div class="form-control">
            <label for="todo_title">Title $titleErrorMessage</label>
            <input type="text" name="todo_title" id="todo_title"
              required aria-required="true" minlength="4" maxlength="55"
              value="$title"
            />
          </div>
          <div class="form-control">
            <label for="todo_description">Description $descriptionErrorMessage</label>
            <textarea name="todo_description" id="todo_description"
              aria-required="false" maxlength="256"
            />$description</textarea>
          </div>
          <div class="form-control">
            <label for="todo_due_date">Due Date $dueDateErrorMessage</label>
            <input type="date" name="todo_due_date" id="todo_due_date"
              aria-required="false" maxlength="256"
              value="$dueDate"
            />
          </div>
          <a class="cancel-icon" href="/todoapp/edit.php?id=$todoListId">Cancel</a>
          <input type="submit" name="submit" value="Save"/>
        </form>
      </article>
    XML;
  }
}
?>