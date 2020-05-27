<?php
require_once('./api/user.php');
require_once('./lib/fieldValidations.php');

// #region Form Validation Functions
function validateUserName($value) {
  return fieldValidator($value, [
    "rule_required",
    ["rule_minLength", 4],
    ["rule_maxLength", 20]
  ]);
}

function validatePassword($value) {
  return fieldValidator($value, [
    "rule_required",
    ["rule_minLength", 4],
    ["rule_maxLength", 256],
    "rule_includesCaps",
    "rule_includesLower",
    "rule_includesNumbers",
    "rule_includesSpecial"
  ]);
}
// #endregion

$userName = getFieldValue('user_name');
$password = getFieldValue('password');
$passwordConfirm = getFieldValue('password_confirm');
$email = getFieldValue('email');
$firstName = getFieldValue('first_name');
$lastName = getFieldValue('last_name');

$userNameState = validateUserName($userName);
$passwordState = validatePassword($password);


if(isset($_POST['submit'])) {
  if ($password === $passwordConfirm) {
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