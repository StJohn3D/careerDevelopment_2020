<?php
require_once('./lib/stringTests.php');

function getFieldValue($fieldName) {
  if(isset($_POST[$fieldName])) {
    return $_POST[$fieldName];
  } else {
    return "";
  }
}

$userName = getFieldValue('user_name');
$password = getFieldValue('password');
$passwordConfirm = getFieldValue('password_confirm');
$email = getFieldValue('email');
$firstName = getFieldValue('first_name');
$lastName = getFieldValue('last_name');

function validationResponse($isValid=true, $errorMessage="") {
  return (object)array('valid'=>$isValid, 'errorMessage'=>$errorMessage);
}

function rule_required($value) {
  if ($value === "") {
    return validationResponse(false, "Required");
  }
  return validationResponse();
};

function fieldValidator($fieldValue, $rulesArray) {
  $res = validationResponse();
  foreach ($rulesArray as $checkRule) {
    if (!is_callable($checkRule)) continue;

    $res = $checkRule($fieldValue);
    
    if (!$res->valid) break;
  }
  return $res;
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

function validateUserName($value) {
  return fieldValidator($value, ["rule_required"]);
}

?>