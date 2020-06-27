<?php
require_once('./db/Todo.php');

class TodoItem_View {
  public static function render($todoData, $todoListId, $editButtonsEnabled) {

    $disabledState = $editButtonsEnabled ? "" : "disabled";
    $ariaDisabled = $editButtonsEnabled ? "" : "aria-disabled=\"true\"";
    $disabledClass = $editButtonsEnabled ? "" : " edit-icon--disabled";

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

    if (isset($_POST[$toggleFieldName])) {
      Todo::setChecked($todoData->id, !$todoData->completed);
      echo "<meta http-equiv='refresh' content='0'>";
    }
    
    return <<<XML
      <article className="todo-card" style="border: 1px solid; padding: 16px;">
        <section class="todo-card__completed-toggle">
          <form method="post" style="font-size: 2rem;">
            <input type="submit" name="$toggleFieldName" id="$toggleFieldName" class="checkbox checkbox--$toggleState" value="$toggleValue"/>
          </form>
        </section>
        <section class="todo-card__details">
          <h1 class="todo-card__title">$todoData->title</h1>
          <p class="todo-card__description">$todoData->description</p>
        </section>
        $dueDate
        <aside>
          <a $disabledState $ariaDisabled class="edit-icon$disabledClass" href="/todoapp/edit.php?id=$todoListId&edit=$todoData->id">Edit</a>
        </aside>
      </article>

    XML;
  }
}
?>