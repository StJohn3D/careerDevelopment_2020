<?php
  require_once('signup-ctrl.php');
  require_once('./components/Page.php');

  $headerContent = <<<XML
    <h1>Already a member?</h1>
    <a href="/todoapp/login.php">Login In</a>
  XML;

  $userNameErrorMessage = $userNameState->valid ? "" : <<<XML
    <b>$userNameState->errorMessage</b>
  XML;

  $passwordErrorMessage = $passwordState->valid ? "" : <<<XML
    <b>$passwordState->errorMessage</b>
  XML;

  $passwordConfirmErrorMessage = $passwordConfirmState->valid ? "" : <<<XML
    <b>$passwordConfirmState->errorMessage</b>
  XML;

  $emailErrorMessage = $emailState->valid ? "" : <<<XML
    <b>$emailState->errorMessage</b>
  XML;

  $firstNameErrorMessage = $firstNameState->valid ? "" : <<<XML
    <b>$firstNameState->errorMessage</b>
  XML;

  $lastNameErrorMessage = $lastNameState->valid ? "" : <<<XML
    <b>$lastNameState->errorMessage</b>
  XML;

  $bodyContent = <<<XML
    <form method="post" action="signup.php">
      <div class="form-control">
        <label for="user_name">User Name $userNameErrorMessage</label>
        <input type="text" name="user_name" id="user_name"
          required aria-required="true" minlength="4" maxlength="55"
          value="$userName"
        />
      </div>
      <div class="form-control">
        <label for="password">Password $passwordErrorMessage</label>
        <input type="password" name="password" id="password"
          required aria-required="true" minlength="4" maxlength="256"
          value="$password"
        />
      </div>
      <div class="form-control">
        <label for="password_confirm">Confirm Password $passwordConfirmErrorMessage</label>
        <input type="password" name="password_confirm" id="password_confirm"
          required aria-required="true" minlength="4" maxlength="256"
          value="$passwordConfirm"
        />
      </div>
      <div class="form-control">
        <label for="email">Email $emailErrorMessage</label>
        <input type="email" name="email" id="email"
          required aria-required="true" maxlength="256"
          value="$email"
        />
      </div>
      <div class="form-control">
        <label for="first_name">First Name $firstNameErrorMessage</label>
        <input type="text" name="first_name" id="first_name"
          aria-required="false" maxlength="256"
          value="$firstName"
        />
      </div>
      <div class="form-control">
        <label for="last_name">Last Name $lastNameErrorMessage</label>
        <input type="text" name="last_name" id="last_name"
          aria-required="false" maxlength="256"
          value="$lastName"
        />
      </div>
      <input type="submit" name="submit" value="Sign Up"/>
    </form>
  XML;

  new Page("Sign Up", $headerContent, $bodyContent);
?>