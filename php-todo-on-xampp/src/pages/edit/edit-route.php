<?php
  require_once('edit-ctrl.php');
  require_once('./components/Page.php');
  require_once('./components/AuthedHeader.php');
  require_once('TodoList_Details_View.php');
  require_once('TodoList_Details_Edit.php');

  $headerContent = AuthedHeader::render($userData);

  // $titleErrorMessage = $titleState->valid ? "" : <<<XML
  //   <b>$titleState->errorMessage</b>
  // XML;

  // $descriptionErrorMessage = $descriptionState->valid ? "" : <<<XML
  //   <b>$descriptionState->errorMessage</b>
  // XML;

  $listTitleDescriptionForm = $activeEditing === 'details'
    ? TodoList_Details_Edit::render($todoListData)
    : TodoList_Details_View::render($todoListData)
  ;

  $todosContent = "";
  foreach ($todosData as $todoData) {
    $todosContent .= <<<XML
      <article className="todo_card" style="border: 1px solid; padding: 16px;">
        <form method="post" action="$formSubmitAddress">
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
          <div class="form-control">
            <label for="todo_complete_$todoData->id">Completed</label>
            <input type="checkbox" name="todo_completed" id="todo_complete_$todoData->id"
              aria-required="false"
              checked="$todoData->completed"
            />
          </div>
          <input type="submit" name="delete-todo" value="Delete"/>
        </form>
      </article>
    XML;
  }

  $completionStatusAndDeleteBtn = <<<XML
    <aside>
      <p>$countsData->numCompleted/$countsData->numTodos</p>
      <form method="post" action="$formSubmitAddress">
        <input type="submit" name="delete-prompt" value="Delete"/>
      </form>
    </aside>
  XML;

  $deletePrompt = !isset($_POST['delete-prompt']) ? "" : <<<XML
    <form method="post" action="$formSubmitAddress">
      <div class="modal">
        <section class="modal__header">
          <h1>Warning</h1>
        </section>
        <section class="modal__body">
          <p>This is a destructive action and cannot be undone.</br>Are you sure you want to delete this ToDo list?</p>
        </section>
        <section class="modal__footer">
            <input type="submit" name="delete-cancel" value="No, Cancel" />
            <input type="submit" name="delete-confirm" value="Yes, Delete" />
        </section>
      </div>
    </form>
  XML;

  $bodyContent = <<<XML
    <a href="/todoapp/index.php">Back</a>
    $listTitleDescriptionForm
    <section class="todos">
      $todosContent
    </section>
    $completionStatusAndDeleteBtn
    $deletePrompt
  XML;

  new Page("Edit", $headerContent, $bodyContent);
?>