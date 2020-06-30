<?php
class TodoList_Details_View {
  public static function render($todoListData, $editButtonsEnabled) {

    $editButton = "";
    if ($editButtonsEnabled) {
      $editButton = <<<XML
        <a class="btn" href="/todoapp/todo.php?id=$todoListData->id&edit=details" title="Edit the title & description">Edit</a>
      XML;
    } else {
      $editButton = <<<XML
        <button class="btn" disabled aria-disabled="true" title="disabled">Edit</button>
      XML;
    }

    return <<<XML
      <section class="todo-list-details todo-list-details--view">
        <p class="todo-list-details__description">$todoListData->description</p>
        $editButton
      </section>
    XML;
  }
}
?>