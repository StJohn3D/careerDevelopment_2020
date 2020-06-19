<?php
  require_once('login-ctrl.php');
  require_once('./components/Page.php');
  require_once('loginHeader.php');

  $invalidMessage = !$invalidLogin ? "" : <<<XML
    <p class=\"invalid-message\">Invalid User Name or Password</p>
  XML;

  $userNameErrorMessage = $userNameOrEmailState->valid ? "" : <<<XML
    <b>$userNameOrEmailState->errorMessage</b>
  XML;

  $passwordErrorMessage = $passwordState->valid ? "" : <<<XML
    <b>$passwordState->errorMessage</b>
  XML;

  $bodyContent = <<<XML
    $invalidMessage
    <form method="post" action="login.php">
      <div class="form-control">
        <label for="user_name_or_email">User Name or Email $userNameErrorMessage</label>
        <input type="text" name="user_name_or_email" id="user_name_or_email"
          required aria-required="true" maxlength="55"
          value="$userNameOrEmail"
        />
      </div>
      <div class="form-control">
        <label for="password">Password $passwordErrorMessage</label>
        <input type="password" name="password" id="password"
          required aria-required="true" maxlength="256"
          value="$password"
        />
      </div>
      <input type="submit" name="submit" value="Login"/>
    </form>
  XML;

  new Page("Login", $loginHeader, $bodyContent);
?>