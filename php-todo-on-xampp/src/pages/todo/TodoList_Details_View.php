<?php
class TodoList_Details_View {
  public static function render($todoListData, $editButtonsEnabled) {

    $disabledState = $editButtonsEnabled ? "" : "disabled";
    $ariaDisabled = $editButtonsEnabled ? "" : "aria-disabled=\"true\"";
    $disabledClass = $editButtonsEnabled ? "" : " edit-icon--disabled";

    return <<<XML
      <section class="todo-list-details">
        <h1 class="todo-list-details__title">$todoListData->title</h1>
        <p class="todo-list-details__description">$todoListData->description</p>
        <a $disabledState $ariaDisabled class="edit-icon$disabledClass" href="/todoapp/todo.php?id=$todoListData->id&edit=details">Edit</a>
      </section>
    XML;
  }
}
?>