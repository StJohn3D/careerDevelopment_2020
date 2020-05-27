<?php
require_once('./api/user.php');
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

if(isset($_POST['submit'])) {
  if (false) {
    $userId = user_add($userName, $password, $email, $firstName, $lastName);
  
    if ($userId > -1) {
      $timeToExpire = time() + (60 * 60); //60 seconds * 60 minutes = 1 hour
      $accessKey = user_access_key($userName, $email);
      setcookie("userId", $userId, $timeToExpire, "/", "", 0);
      setcookie("accessKey", $accessKey, $timeToExpire, "/", "", 0);
      header('Location: '.$uri.'/todoapp/index.php/');
      exit;
    }
  }
}
?>