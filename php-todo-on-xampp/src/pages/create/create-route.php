<?php
  require_once('create-ctrl.php');
  require_once('./components/Page.php');
  require_once('./components/AuthedHeader.php');

  $headerContent = AuthedHeader::render($userData);

  $titleErrorMessage = $titleState->valid ? "" : <<<XML
    <b>$titleState->errorMessage</b>
  XML;

  $descriptionErrorMessage = $descriptionState->valid ? "" : <<<XML
    <b>$descriptionState->errorMessage</b>
  XML;

  $bodyContent = <<<XML
    <form method="post" action="create.php">
      <div class="form-control">
        <label for="title">Title $titleErrorMessage</label>
        <input type="text" name="title" id="title"
          required aria-required="true" minlength="4" maxlength="55"
          value="$title"
        />
      </div>
      <div class="form-control">
        <label for="description">Description $descriptionErrorMessage</label>
        <textarea name="description" id="description"
          aria-required="false" maxlength="256"
        />$description</textarea>
      </div>
      <a href="/todoapp/index.php?">Cancel</a>
      <input type="submit" name="submit" value="Create"/>
    </form>
  XML;

  new Page("Create new ToDo list", $headerContent, $bodyContent, null);
?>