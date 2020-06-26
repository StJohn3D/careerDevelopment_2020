<?php
require_once('./db/TodoList.php');
require_once('./lib/fieldHelpers.php');
require_once('./pages/create/create-formValidators.php');

class TodoList_Details_Edit {
  public static function render($todoListData) {
    $title = getFieldValue('todo_list_title', $todoListData->title);
    $description = getFieldValue('todo_list_description', $todoListData->description);

    $titleState = validateTitle($title);
    $descriptionState = validateDescription($description);

    $formIsValid =
      $titleState->valid &&
      $descriptionState->valid
    ;

    if (isset($_POST['submit']) && $formIsValid) {
      $todoListId = TodoList::edit($todoListData->id, $title, $description);

      header('Location: '.$uri."/todoapp/edit.php?id=$todoListData->id");
      exit;
    }

    $titleErrorMessage = $titleState->valid ? "" : <<<XML
      <b>$titleState->errorMessage</b>
    XML;

    $descriptionErrorMessage = $descriptionState->valid ? "" : <<<XML
      <b>$descriptionState->errorMessage</b>
    XML;

    return <<<XML
      <section class="todo-list-details" style="border: 1px solid; padding: 16px;">
        <form method="post">
          <div class="form-control">
            <label for="todo_list_title">Title $titleErrorMessage</label>
            <input type="text" name="todo_list_title" id="todo_list_title"
              required aria-required="true" minlength="4" maxlength="256"
              value="$title"
            />
          </div>
          <div class="form-control">
            <label for="todo_list_description">Description $descriptionErrorMessage</label>
            <textarea name="todo_list_description" id="todo_list_description"
            aria-required="false" maxlength="256"
            />$description</textarea>
          </div>
          <a class="cancel-icon" href="/todoapp/edit.php?id=$todoListData->id">Cancel</a>
          <input type="submit" name="submit" value="Save"/>
        </form>
      </section>
    XML;
  }
}
?>