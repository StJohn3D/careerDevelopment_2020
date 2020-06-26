<?php
require_once('./db/Todo.php');
require_once('./lib/fieldHelpers.php');
// require_once('./pages/create/create-formValidators.php');

class TodoItem_Edit {
  public static function render($todoData, $todoListId) {
    // $title = getFieldValue('todo_list_title', $todoListData->title);
    // $description = getFieldValue('todo_list_description', $todoListData->description);

    // $titleState = validateTitle($title);
    // $descriptionState = validateDescription($description);

    // $formIsValid =
    //   $titleState->valid &&
    //   $descriptionState->valid
    // ;

    // if (isset($_POST['submit']) && $formIsValid) {
    //   $todoListId = TodoList::edit($todoListData->id, $title, $description);

    //   header('Location: '.$uri."/todoapp/edit.php?id=$todoListData->id");
    //   exit;
    // }

    // $titleErrorMessage = $titleState->valid ? "" : <<<XML
    //   <b>$titleState->errorMessage</b>
    // XML;

    // $descriptionErrorMessage = $descriptionState->valid ? "" : <<<XML
    //   <b>$descriptionState->errorMessage</b>
    // XML;

    return <<<XML
      <article className="todo_card" style="border: 1px solid; padding: 16px;">
        <form method="post">
          <div class="form-control">
            <label for="todo_title_$todoData->id">Title</label>
            <input type="text" name="todo_title" id="todo_title_$todoData->id"
              required aria-required="true" minlength="4" maxlength="55"
              value="$todoData->title"
            />
          </div>
          <div class="form-control">
            <label for="todo_description_$todoData->id">Description</label>
            <textarea name="todo_description" id="todo_description_$todoData->id"
              aria-required="false" maxlength="256"
            />$todoData->description</textarea>
          </div>
          <div class="form-control">
            <label for="todo_due_date_$todoData->id">Due Date</label>
            <input type="date" name="todo_due_date" id="todo_due_date_$todoData->id"
              aria-required="false" maxlength="256"
              value="$todoData->dueDate"
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