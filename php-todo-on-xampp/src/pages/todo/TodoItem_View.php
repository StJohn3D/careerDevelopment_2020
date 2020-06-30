<?php
require_once('./db/Todo.php');

class TodoItem_View {
  public static function render($todoData, $todoListId, $editButtonsEnabled) {

    $disabledState = $editButtonsEnabled ? "" : "disabled";
    $ariaDisabled = $editButtonsEnabled ? "" : "aria-disabled=\"true\"";
    $editIconDisabledClass = $editButtonsEnabled ? "" : " edit-icon--disabled";
    $deleteIconDisabledClass = $editButtonsEnabled ? "" : " trashcan--disabled";

    $toggleState = $todoData->completed ? "checked" : "unchecked";
    $toggleValue = $todoData->completed ? "☑" : "☐";

    $dueDate = "";
    if ($todoData->dueDate !== null) {
      $dateTime = new DateTime($todoData->dueDate);
      $formatted = $dateTime->format('m/d/Y');
      $dueDate = <<<XML
        <aside class="due-date">
          <h1>Due on $formatted</h1>
        </aside>
      XML;
    }

    $toggleFieldName = "completed_toggle_$todoData->id";
    $deleteFieldName = "delete_$todoData->id";

    if (isset($_POST[$toggleFieldName])) {
      Todo::setChecked($todoData->id, !$todoData->completed);
      echo "<meta http-equiv='refresh' content='0'>";
    }

    if (isset($_POST[$deleteFieldName])) {
      Todo::delete($todoData->id);
      echo "<meta http-equiv='refresh' content='0'>";
    }

    $editButton = "";
    if (!$todoData->completed) {
      $editButton = <<<XML
        <a $disabledState $ariaDisabled class="edit-icon$editIconDisabledClass" href="/todoapp/todo.php?id=$todoListId&edit=$todoData->id">Edit</a>
      XML;
    }
    
    return <<<XML
      <article className="todo-card" style="border: 1px solid; padding: 16px;">
        <section class="todo-card__actions">
          <form method="post" style="font-size: 2rem;">
            <input type="submit" name="$toggleFieldName" id="$toggleFieldName" class="checkbox checkbox--$toggleState" value="$toggleValue"/>
          </form>
          $editButton
        </section>
        <section class="todo-card__details">
          <h1 class="todo-card__title">$todoData->title</h1>
          <p class="todo-card__description">$todoData->description</p>
        </section>
        $dueDate
        <aside>
          <form method="post">
            <input $disabledState $ariaDisabled type="submit" name="$deleteFieldName" id="$deleteFieldName" class="trashcan $deleteIconDisabledClass" value="delete"/>
          </form>
        </aside>
      </article>

    XML;
  }
}
?>