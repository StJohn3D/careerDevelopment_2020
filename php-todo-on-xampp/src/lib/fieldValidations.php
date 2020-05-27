<?php
require_once('./lib/stringTests.php');

function validationResponse($isValid=true, $errorMessage="") {
  return (object)array('valid'=>$isValid, 'errorMessage'=>$errorMessage);
}

function fieldValidator($fieldValue, $rulesArray) {
  $res = validationResponse();
  
  foreach ($rulesArray as $checkRule) {
    if (is_array($checkRule)) {
      $ruleName = array_shift($checkRule);
      if (is_callable($ruleName)) {
        $ruleArgs = $checkRule;
        array_unshift($ruleArgs, $fieldValue);
        $res = call_user_func_array($ruleName, $ruleArgs);
      }
    } else {
      if (!is_callable($checkRule)) continue;
      $res = $checkRule($fieldValue);
    }
    if (!$res->valid) break;
  }
  return $res;
}

function rule_required($value) {
  if ($value === "") {
    return validationResponse(false, "Required");
  }
  return validationResponse();
};

function rule_minLength($value, $length) {
  if (!stringHasMinLength($value, $length)) {
    return validationResponse(false, "Too short!");
  }
  return validationResponse();
}

function rule_maxLength($value, $length) {
  if (!stringHasMaxLength($value, $length)) {
    return validationResponse(false, "Too long!");
  }
  return validationResponse();
}

function rule_includesCaps($value) {
  if (!stringIncludesCapitalLetters($value)) {
    return validationResponse(false, "Must have at least one capital letter");
  }
  return validationResponse();
}

function rule_includesLower($value) {
  if (!stringIncludesLowercaseLetters($value)) {
    return validationResponse(false, "Must have at least one lowercase letter");
  }
  return validationResponse();
}

function rule_includesNumbers($value) {
  if (!stringIncludesNumbers($value)) {
    return validationResponse(false, "Must have at least one number");
  }
  return validationResponse();
}

function rule_includesSpecial($value) {
  if (!stringIncludesSpecialCharacters($value)) {
    return validationResponse(false, "Must have at least one special character");
  }
  return validationResponse();
}

function rule_isEmail($value) {
  if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
    return validationResponse(false, "Must be a valid email");
  }
  return validationResponse();
}
?>