<?php
require_once('./lib/fieldValidations.php');

function validateUserName($value) {
  return fieldValidator($value, [
    "rule_required",
    ["rule_maxLength", 55]
  ]);
}

function validatePassword($value) {
  return fieldValidator($value, [
    "rule_required",
    ["rule_maxLength", 256]
  ]);
}

?>