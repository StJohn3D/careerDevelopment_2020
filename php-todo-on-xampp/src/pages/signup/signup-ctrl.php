<?php
require_once('./api/user.php');
require_once('./lib/fieldValidations.php');

// #region Form Validation Functions
function validateUserName($value) {
  return fieldValidator($value, [
    "rule_required",
    ["rule_minLength", 4]
  ]);
}

function validatePassword($value) {
  $result = (object)array('valid'=>true, 'errorMessage'=>"");

  if ($value === "") {
    $result->valid = false;
    $result->errorMessage = "Required";
    return $result;
  }

  if (!stringHasMinLength($value, 4)) {
    $result->valid = false;
    $result->errorMessage = "Too short!";
  }

  if (!stringHasMaxLength($value, 256)) {
    $result->valid = false;
    $result->errorMessage = "Too long!";
  }

  if (!stringIncludesCapitalLetters($value)) {
    $result->valid = false;
    $result->errorMessage = "Must have at least one capital letter";
  }

  if (!stringIncludesLowercaseLetters($value)) {
    $result->valid = false;
    $result->errorMessage = "Must have at least one lowercase letter";
  }

  if (!stringIncludesNumbers($value)) {
    $result->valid = false;
    $result->errorMessage = "Must have at least one number";
  }

  if (!stringIncludesSpecialCharacters($value)) {
    $result->valid = false;
    $result->errorMessage = "Must have at least one special character";
  }
  
  return $result;
}
// #endregion

$userName = getFieldValue('user_name');
$password = getFieldValue('password');
$passwordConfirm = getFieldValue('password_confirm');
$email = getFieldValue('email');
$firstName = getFieldValue('first_name');
$lastName = getFieldValue('last_name');

$userNameState = validateUserName($userName);
$passwordState = (object)array('valid'=>true, 'errorMessage'=>"");
$passwordState = validatePassword("AAA");


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