<?php
require_once('./lib/stringTests.php');

function getFieldValue($fieldName) {
  if(isset($_POST[$fieldName])) {
    return $_POST[$fieldName];
  } else {
    return "";
  }
}

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

?>