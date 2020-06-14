<?php
require_once('./lib/fieldValidations.php');
require_once('./db/Person.php');

function validateTitle($value) {
  return fieldValidator($value, [
    "rule_required",
    ["rule_minLength", 4],
    ["rule_maxLength", 55]
  ]);
}

function validateDescription($value) {
  return fieldValidator($value, [
    ["rule_maxLength", 256],
  ]);
}
?>