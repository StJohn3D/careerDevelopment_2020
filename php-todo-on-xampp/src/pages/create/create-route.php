<?php
  require_once('create-ctrl.php');
  require_once('./components/Page.php');
  require_once('./components/AuthedHeader.php');
  require_once('./components/requiredAsterisk.php');
  require_once('./lib/attributeHelpers.php');

  $headerContent = AuthedHeader::render($userData);

  $titleErrorMessage = $titleState->valid ? "" : <<<XML
    <b>$titleState->errorMessage</b>
  XML;
  $titleInvalidAttributes = getInvalidAttributes($titleState->valid);

  $descriptionErrorMessage = $descriptionState->valid ? "" : <<<XML
    <b>$descriptionState->errorMessage</b>
  XML;
  $descriptionInvalidAttributes = getInvalidAttributes($descriptionState->valid);

  $bodyContent = <<<XML
    <form method="post" action="create.php">
      <div class="form-control">
        <label for="title">Title$requiredAsterisk $titleErrorMessage</label>
        <input type="text" name="title" id="title"
          required aria-required="true" minlength="4" maxlength="55" $titleInvalidAttributes
          value="$title"
        />
      </div>
      <div class="form-control">
        <label for="description">Description $descriptionErrorMessage</label>
        <textarea name="description" id="description"
          aria-required="false" maxlength="256" $descriptionInvalidAttributes
        />$description</textarea>
      </div>
      <a class="btn" href="/todoapp/index.php?">Cancel</a>
      <input class="btn btn--primary" type="submit" name="submit" value="Create"/>
    </form>
  XML;

  new Page("Create new ToDo list", $headerContent, $bodyContent, null);
?>