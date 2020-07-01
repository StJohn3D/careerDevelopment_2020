<?php
  require_once('signup-ctrl.php');
  require_once('./components/Page.php');
  require_once('./components/requiredAsterisk.php');
  require_once('./lib/attributeHelpers.php');

  $headerContent = <<<XML
    <label>Already a member?</label>
    <a class="btn btn--light" href="/todoapp/login.php">Login In</a>
  XML;

  $userNameErrorMessage = $userNameState->valid ? "" : <<<XML
    <b>$userNameState->errorMessage</b>
  XML;
  $userNameInvalidAttributes = getInvalidAttributes($userNameState->valid);

  $passwordErrorMessage = $passwordState->valid ? "" : <<<XML
    <b>$passwordState->errorMessage</b>
  XML;
  $passwordInvalidAttributes = getInvalidAttributes($passwordState->valid);

  $passwordConfirmErrorMessage = $passwordConfirmState->valid ? "" : <<<XML
    <b>$passwordConfirmState->errorMessage</b>
  XML;
  $passwordConfirmInvalidAttributes = getInvalidAttributes($passwordConfirmState->valid);

  $emailErrorMessage = $emailState->valid ? "" : <<<XML
    <b>$emailState->errorMessage</b>
  XML;
  $emailInvalidAttributes = getInvalidAttributes($emailState->valid);

  $firstNameErrorMessage = $firstNameState->valid ? "" : <<<XML
    <b>$firstNameState->errorMessage</b>
  XML;
  $firstNameInvalidAttributes = getInvalidAttributes($firstNameState->valid);

  $lastNameErrorMessage = $lastNameState->valid ? "" : <<<XML
    <b>$lastNameState->errorMessage</b>
  XML;
  $lastNameInvalidAttributes = getInvalidAttributes($lastNameState->valid);

  $bodyContent = <<<XML
    <form method="post" action="signup.php">
      <div class="form-control">
        <label for="user_name">User Name$requiredAsterisk $userNameErrorMessage</label>
        <input type="text" name="user_name" id="user_name"
          required aria-required="true" minlength="4" maxlength="55" $userNameInvalidAttributes
          value="$userName"
        />
      </div>
      <div class="form-control">
        <label for="password">Password$requiredAsterisk $passwordErrorMessage</label>
        <input type="password" name="password" id="password"
          required aria-required="true" minlength="4" maxlength="256" $passwordInvalidAttributes
          value="$password"
        />
      </div>
      <div class="form-control">
        <label for="password_confirm">Confirm Password$requiredAsterisk $passwordConfirmErrorMessage</label>
        <input type="password" name="password_confirm" id="password_confirm"
          required aria-required="true" minlength="4" maxlength="256" $passwordConfirmInvalidAttributes
          value="$passwordConfirm"
        />
      </div>
      <div class="form-control">
        <label for="email">Email$requiredAsterisk $emailErrorMessage</label>
        <input type="email" name="email" id="email"
          required aria-required="true" maxlength="256" $emailInvalidAttributes
          value="$email"
        />
      </div>
      <div class="form-control">
        <label for="first_name">First Name $firstNameErrorMessage</label>
        <input type="text" name="first_name" id="first_name"
          aria-required="false" maxlength="256" $firstNameInvalidAttributes
          value="$firstName"
        />
      </div>
      <div class="form-control">
        <label for="last_name">Last Name $lastNameErrorMessage</label>
        <input type="text" name="last_name" id="last_name"
          aria-required="false" maxlength="256" $lastNameInvalidAttributes
          value="$lastName"
        />
      </div>
      <input class="btn btn--primary" type="submit" name="submit" value="Sign Up"/>
    </form>
  XML;

  new Page("Sign Up", $headerContent, $bodyContent, null, "signup.css");
?>