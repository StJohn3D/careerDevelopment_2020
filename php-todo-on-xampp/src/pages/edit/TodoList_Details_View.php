<?php
class TodoList_Details_View {
  public static function render($todoListData) {
    return <<<XML
      <section class="todo-list-details" style="border: 1px solid; padding: 16px;">
        <h1 class="todo-list-details__title">$todoListData->title</h1>
        <p class="todo-list-details__description">$todoListData->description</p>
        <a class="edit-icon" href="/todoapp/edit.php?id=$todoListData->id&edit=details">Edit</a>
      </section>
    XML;
  }
}
?>