<?php
  require_once('edit-ctrl.php');
  require_once('./components/Page.php');
  require_once('./components/AuthedHeader.php');
  require_once('TodoItem_View.php');
  require_once('TodoItem_Create.php');

  $headerContent = AuthedHeader::render($userData);
  
  $todoListDetailsSection = "";
  if ($activeEditing === 'details') {
    require_once('TodoList_Details_Edit.php');
    $todoListDetailsSection = TodoList_Details_Edit::render($todoListData);
  } else {
    require_once('TodoList_Details_View.php');
    $todoListDetailsSection = TodoList_Details_View::render($todoListData, $editButtonsEnabled);
  }

  $createSection = TodoItem_Create::render($activeEditing === 'new', $todoListData->id, $editButtonsEnabled);

  function notDone($todoData) {
    return !$todoData->completed;
  }
  function done($todoData) {
    return $todoData->completed;
  }

  $todosContent = "";
  foreach (array_filter($todosData, "notDone") as $todoData) {
    if ($activeEditing === $todoData->id) {
      require_once('TodoItem_Edit.php');
      $todosContent .= TodoItem_Edit::render($todoData, $todoListData->id);
    } else {
      $todosContent .= TodoItem_View::render($todoData, $todoListData->id, $editButtonsEnabled);
    }
  }

  $completedTodosContent = "";
  foreach (array_filter($todosData, "done") as $todoData) {
    $completedTodosContent .= TodoItem_View::render($todoData, $todoListData->id, $editButtonsEnabled);
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
    <a href="/todoapp/index.php">Home</a>
    $completionStatusAndDeleteBtn
    $deletePrompt
    $todoListDetailsSection
    <br/>
    $createSection
    <hr/>
    <section class="todos">
      <h1>Todo</h1>
      $todosContent
    </section>
    <section class="completed">
      <h1>Done</h1>
      $completedTodosContent
    </section>
  XML;

  new Page("Edit", $headerContent, $bodyContent, null);
?>