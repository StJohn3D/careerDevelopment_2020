<?php
require_once('./lib/fieldValidations.php');

function validateTodoTitle($value) {
  return fieldValidator($value, [
    "rule_required",
    ["rule_minLength", 4],
    ["rule_maxLength", 55]
  ]);
}

function validateTodoDescription($value) {
  return fieldValidator($value, [
    ["rule_maxLength", 256],
  ]);
}

function validateTodoDueDate($value) {
  if ($value === null || $value === "") {
    return validationResponse();
  }
  return fieldValidator($value, [
    ["rule_isDateString", 'Y-m-d'],
  ]);
}
?>