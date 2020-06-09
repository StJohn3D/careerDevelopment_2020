<?php
require_once('./lib/fieldValidations.php');

function validateUserNameOrEmail($value) {
  return fieldValidator($value, [
    "rule_required",
    ["rule_maxLength", 256]
  ]);
}

function validatePassword($value) {
  return fieldValidator($value, [
    "rule_required",
    ["rule_maxLength", 256]
  ]);
}

?>