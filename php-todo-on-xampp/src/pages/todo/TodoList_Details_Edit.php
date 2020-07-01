<?php
require_once('./db/TodoList.php');
require_once('./lib/fieldHelpers.php');
require_once('./lib/attributeHelpers.php');
require_once('./pages/create/create-formValidators.php');

class TodoList_Details_Edit {
  public static function render($todoListData) {
    require_once('./components/requiredAsterisk.php');

    $title = getFieldValue('todo_list_title', $todoListData->title);
    $description = getFieldValue('todo_list_description', $todoListData->description);

    $titleState = validateTitle($title);
    $descriptionState = validateDescription($description);

    $formIsValid =
      $titleState->valid &&
      $descriptionState->valid
    ;

    if (isset($_POST['submit']) && $formIsValid) {
      $success = TodoList::edit($todoListData->id, $title, $description);

      header('Location: '.$uri."/todoapp/todo.php?id=$todoListData->id");
      exit;
    }
    
    if (!isset($_POST['submit'])) {
      $titleState->valid = true;
      $descriptionState->valid = true;
    }

    $titleErrorMessage = $titleState->valid ? "" : <<<XML
      <b>$titleState->errorMessage</b>
    XML;
    $titleInvalidAttributes = getInvalidAttributes($titleState->valid);

    $descriptionErrorMessage = $descriptionState->valid ? "" : <<<XML
      <b>$descriptionState->errorMessage</b>
    XML;
    $descriptionInvalidAttributes = getInvalidAttributes($descriptionState->valid);

    return <<<XML
      <section class="active-form">
        <form method="post">
          <div class="form-control">
            <label for="todo_list_title">Title$requiredAsterisk $titleErrorMessage</label>
            <input type="text" name="todo_list_title" id="todo_list_title"
              required aria-required="true" minlength="4" maxlength="55" $titleInvalidAttributes
              value="$title"
            />
          </div>
          <div class="form-control">
            <label for="todo_list_description">Description $descriptionErrorMessage</label>
            <textarea name="todo_list_description" id="todo_list_description"
            aria-required="false" rows="5" maxlength="256" $descriptionInvalidAttributes
            />$description</textarea>
          </div>
          <div class="button-row">
            <a class="btn" href="/todoapp/todo.php?id=$todoListData->id">Cancel</a>
            <input class="btn btn--primary" type="submit" name="submit" value="Save"/>
          </div>
        </form>
      </section>
    XML;
  }
}
?>