<?php
require_once('./db/Todo.php');

class TodoItem_Create {
  public static function render($isActive, $todoListId, $editButtonsEnabled) {

    $disabledState = $editButtonsEnabled ? "" : "disabled";
    $ariaDisabled = $editButtonsEnabled ? "" : "aria-disabled=\"true\"";
    $disabledClass = $editButtonsEnabled ? "" : " edit-icon--disabled";

    if ($isActive) {
      require_once('TodoItem_Edit.php');
      $startingValues = new TodoDTO();
      return TodoItem_Edit::render($startingValues, $todoListId);
    }

    return <<<XML
      <a $disabledState $ariaDisabled class="todo-create$disabledClass" href="/todoapp/todo.php?id=$todoListId&edit=new">Add new ToDo Item</a>
    XML;
  }
}
?>