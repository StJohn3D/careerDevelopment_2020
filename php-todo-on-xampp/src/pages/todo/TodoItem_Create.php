<?php
require_once('./db/Todo.php');

class TodoItem_Create {
  public static function render($isActive, $todoListId, $editButtonsEnabled) {

    if ($isActive) {
      require_once('TodoItem_Edit.php');
      $startingValues = new TodoDTO();
      return TodoItem_Edit::render($startingValues, $todoListId);
    }

    if ($editButtonsEnabled) {
      return <<<XML
        <a class="btn" href="/todoapp/todo.php?id=$todoListId&edit=new" title="Add new ToDo Item">Add</a>
      XML;
    } else {
      return <<<XML
        <button class="btn" disabled aria-disabled="true" title="disabled">Add</button>
      XML;
    }
  }
}
?>