<?php
require_once('./db/Todo.php');
require_once('./lib/fieldHelpers.php');
require_once('./lib/attributeHelpers.php');
require_once('todo-formValidators.php');

class TodoItem_Edit {
  public static function render($todoData, $todoListId) {
    require_once('./components/requiredAsterisk.php');

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

      header('Location: '.$uri."/todoapp/todo.php?id=$todoListId");
      exit;
    }

    if (!isset($_POST['submit'])) {
      $titleState->valid = true;
      $descriptionState->valid = true;
      $dueDateState->valid = true;
    }

    $titleErrorMessage = $titleState->valid ? "" : <<<XML
      <b>$titleState->errorMessage</b>
    XML;
    $titleInvalidAttributes = getInvalidAttributes($titleState->valid);

    $descriptionErrorMessage = $descriptionState->valid ? "" : <<<XML
      <b>$descriptionState->errorMessage</b>
    XML;
    $descriptionInvalidAttributes = getInvalidAttributes($descriptionState->valid);

    $dueDateErrorMessage = $dueDateState->valid ? "" : <<<XML
      <b>$dueDateState->errorMessage</b>
    XML;
    $dueDateInvalidAttributes = getInvalidAttributes($dueDateState->valid);

    return <<<XML
      <article class="active-form">
        <form method="post">
          <div class="form-control">
            <label for="todo_title">Title$requiredAsterisk $titleErrorMessage</label>
            <input type="text" name="todo_title" id="todo_title"
              required aria-required="true" minlength="4" maxlength="55" $titleInvalidAttributes
              value="$title"
            />
          </div>
          <div class="form-control">
            <label for="todo_description">Description $descriptionErrorMessage</label>
            <textarea name="todo_description" id="todo_description"
              aria-required="false" rows="5" maxlength="256" $descriptionInvalidAttributes
            />$description</textarea>
          </div>
          <div class="form-control">
            <label for="todo_due_date">Due Date $dueDateErrorMessage</label>
            <input type="date" name="todo_due_date" id="todo_due_date"
              aria-required="false" maxlength="256" $dueDateInvalidAttributes
              value="$dueDate"
            />
          </div>
          <div class="button-row">
            <a class="btn" href="/todoapp/todo.php?id=$todoListId">Cancel</a>
            <input class="btn btn--primary" type="submit" name="submit" value="Save"/>
          </div>
        </form>
      </article>
    XML;
  }
}
?>