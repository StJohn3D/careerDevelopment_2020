<?php
  require_once('edit-ctrl.php');
  require_once('./components/Page.php');
  require_once('./components/AuthedHeader.php');

  $headerContent = AuthedHeader::render($userData);

  // $titleErrorMessage = $titleState->valid ? "" : <<<XML
  //   <b>$titleState->errorMessage</b>
  // XML;

  // $descriptionErrorMessage = $descriptionState->valid ? "" : <<<XML
  //   <b>$descriptionState->errorMessage</b>
  // XML;

  $listTitleDescriptionForm = <<<XML
    <section>
      <form method="post" action="$formSubmitAddress">
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
        <a href="/todoapp/index.php?">Cancel</a>
        <input type="submit" name="submit" value="Save"/>
      </form>
    </section>
  XML;

  $completionStatusAndDeleteBtn = <<<XML
    <aside>
      <p>#/#</p>
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
    $listTitleDescriptionForm
    $completionStatusAndDeleteBtn
    $deletePrompt
  XML;

  new Page("Edit", $headerContent, $bodyContent);
?>