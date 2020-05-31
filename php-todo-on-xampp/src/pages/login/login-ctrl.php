<?php
require_once('./api/User.php');
require_once('./lib/fieldHelpers.php');
require_once('login-formValidators.php');

$userName = getFieldValue('user_name');
$password = getFieldValue('password');

$userNameState = validateUserName($userName);
$passwordState = validatePassword($password);

$formIsValid =
  $userNameState->valid &&
  $passwordState->valid
;

$invalidLogin = FALSE;

if (isset($_POST['submit']) && $formIsValid) {
  if($success = User::login($userName, $password)) {
    header('Location: '.$uri.'/todoapp/index.php/');
    exit;
  } else {
    $invalidLogin = TRUE;
  }
}
?>