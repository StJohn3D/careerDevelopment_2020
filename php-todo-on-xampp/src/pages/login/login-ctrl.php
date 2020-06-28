<?php
require_once('./api/User.php');
require_once('./lib/fieldHelpers.php');
require_once('login-formValidators.php');

$userNameOrEmail = getFieldValue('user_name_or_email');
$password = getFieldValue('password');

$userNameOrEmailState = validateUserNameOrEmail($userNameOrEmail);
$passwordState = validatePassword($password);

$formIsValid =
  $userNameOrEmailState->valid &&
  $passwordState->valid
;

$invalidLogin = FALSE;

if (isset($_POST['submit']) && $formIsValid) {
  if($success = User::login($userNameOrEmail, $password)) {
    header('Location: '.$uri.'/todoapp/index.php/');
    exit;
  } else {
    $invalidLogin = TRUE;
  }
}

if (!isset($_POST['submit'])) {
  // Don't show error messages or mark required fields as invalid until after the user clicks submit
  $userNameOrEmailState->valid = true;
  $passwordState->valid = true;
}
?>