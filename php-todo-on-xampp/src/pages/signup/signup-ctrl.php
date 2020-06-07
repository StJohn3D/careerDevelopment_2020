<?php
require_once('./api/User.php');
require_once('./lib/fieldHelpers.php');
require_once('signup-formValidators.php');

$userName = getFieldValue('user_name');
$password = getFieldValue('password');
$passwordConfirm = getFieldValue('password_confirm');
$email = getFieldValue('email');
$firstName = getFieldValue('first_name');
$lastName = getFieldValue('last_name');

$userNameState = validateUserName($userName);
$passwordState = validatePassword($password);
$passwordConfirmState = validatePasswordConfirm($passwordConfirm, $password);
$emailState = validateEmail($email);
$firstNameState = validateFirstName($firstName);
$lastNameState = validateLastName($lastName);

$formIsValid =
  $userNameState->valid &&
  $passwordState->valid &&
  $passwordConfirmState->valid &&
  $emailState->valid &&
  $firstNameState->valid &&
  $lastNameState->valid
;

if (isset($_POST['submit']) && $formIsValid) {
  $userId = User::add($userName, $password, $email, $firstName, $lastName);

  if ($userId > -1) {
    User::login($userName, $password);
    header('Location: '.$uri.'/todoapp/index.php/');
    exit;
  }
}
?>