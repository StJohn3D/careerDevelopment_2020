<?php
require_once('./lib/fieldValidations.php');

function validateUserName($value) {
  return fieldValidator($value, [
    "rule_required",
    ["rule_minLength", 4],
    ["rule_maxLength", 55]
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

function rule_matchPassword($value, $_password) {
  if ($value !== $_password) {
    return validationResponse(false, "Passwords must match");
  }
  return validationResponse();
}

function validatePasswordConfirm($value, $_password) {
  return fieldValidator($value, [
    "rule_required",
    ["rule_matchPassword", $_password]
  ]);
}

function validateEmail($value) {
  return fieldValidator($value, [
    "rule_required",
    "rule_isEmail",
    ["rule_maxLength", 256],
  ]);
}

function validateFirstName($value) {
  return fieldValidator($value, [
    ["rule_maxLength", 256],
  ]);
}

function validateLastName($value) {
  return fieldValidator($value, [
    ["rule_maxLength", 256],
  ]);
}
?>