<?php
  require_once('login-ctrl.php');
  require_once('./components/Page.php');
  require_once('./components/requiredAsterisk.php');
  require_once('./lib/attributeHelpers.php');
  require_once('loginHeader.php');

  $invalidMessage = !$invalidLogin ? "" : <<<XML
    <span class="warning invalid-message"><b>Invalid User Name or Password</b></span>
  XML;

  $userNameErrorMessage = $userNameOrEmailState->valid ? "" : <<<XML
    <b>$userNameOrEmailState->errorMessage</b>
  XML;
  $userNameInvalidAttributes = getInvalidAttributes($userNameOrEmailState->valid);

  $passwordErrorMessage = $passwordState->valid ? "" : <<<XML
    <b>$passwordState->errorMessage</b>
  XML;
  $passwordInvalidAttributes = getInvalidAttributes($passwordState->valid);

  $bodyContent = <<<XML
    $invalidMessage
    <form method="post" action="login.php">
      <div class="form-control">
        <label for="user_name_or_email">User Name or Email$requiredAsterisk $userNameErrorMessage</label>
        <input type="text" name="user_name_or_email" id="user_name_or_email"
          required aria-required="true" maxlength="55" $userNameInvalidAttributes
          value="$userNameOrEmail"
        />
      </div>
      <div class="form-control">
        <label for="password">Password$requiredAsterisk $passwordErrorMessage</label>
        <input type="password" name="password" id="password"
          required aria-required="true" maxlength="256" $passwordInvalidAttributes
          value="$password"
        />
      </div>
      <input class="btn btn--primary" type="submit" name="submit" value="Login"/>
    </form>
  XML;

  new Page("Login", $loginHeader, $bodyContent, "", "login.css");
?>