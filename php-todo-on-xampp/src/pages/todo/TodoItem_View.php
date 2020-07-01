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
        <p>Due on $formatted</p>
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

    $description = "";
    if ($todoData->description !== null && $todoData->description !== "") {
      $description = <<<XML
        <div class="grid-area--description">
          <p class="todo-item-card__description">$todoData->description</p>
        </div>
      XML;
    }

    $editButton = "";
    if (!$todoData->completed) {
      if ($editButtonsEnabled) {
        $editButton = <<<XML
          <a class="btn" href="/todoapp/todo.php?id=$todoListId&edit=$todoData->id">Edit</a>
        XML;
      } else {
        $editButton = <<<XML
          <button $disabledState $ariaDisabled class="btn" title="disabled">Edit</button>
        XML;
      }
    }

    $completedClass = $todoData->completed ? " todo-item-card--completed" : "";
    
    return <<<XML
      <article class="todo-item-card$completedClass">
        <div class="grid-area--title">
          <h1 class="todo-item-card__title">$todoData->title</h1>
        </div>
        $description
        <div class="grid-area--due-date">
          $dueDate
        </div>
        <div class="grid-area--toggle">
          <form method="post">
            <input type="submit" name="$toggleFieldName" id="$toggleFieldName" class="checkbox checkbox--$toggleState" value="$toggleValue"/>
          </form>
        </div>
        <div class="grid-area--actions">
          <form method="post">
            $editButton
            <input type="submit" name="$deleteFieldName" id="$deleteFieldName" class="btn btn--danger" title="Delete todo item: $todoData->title" value="Delete"/>
          </form>
        </div>
      </article>

    XML;
  }
}
?>