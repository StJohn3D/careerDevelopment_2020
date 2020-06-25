<?php
class TodoList_Details_Edit {
  public static function render($todoListData) {
    return <<<XML
      <section class="todo-list-details" style="border: 1px solid; padding: 16px;">
        <form method="post">
          <div class="form-control">
            <label for="todo_list_title">Title</label>
            <input type="text" name="todo_list_title" id="todo_list_title"
              required aria-required="true" minlength="4" maxlength="256"
              value="$todoListData->title"
            />
          </div>
          <div class="form-control">
            <label for="todo_list_description">Description</label>
            <textarea name="todo_list_description" id="todo_list_description"
            aria-required="false" maxlength="256"
            />$todoListData->description</textarea>
          </div>
          <a class="cancel-icon" href="/todoapp/edit.php?id=$todoListData->id">Cancel</a>
          <input type="submit" name="submit" value="Save"/>
        </form>
      </section>
    XML;
  }
}
?>