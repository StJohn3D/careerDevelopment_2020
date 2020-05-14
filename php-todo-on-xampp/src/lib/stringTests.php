<?php
function stringHasMinLength($value, $length) {
  return strlen($value) >= $length;
}

function stringHasMaxLength($value, $length) {
  return strlen($value) <= $length;
}

function stringIncludesCapitalLetters($value) {
  if (preg_match('/[A-Z]/', $value)) {
    return true;
  } else { return false; }
}

function stringIncludesLowercaseLetters($value) {
  if (preg_match('/[a-z]/', $value)) {
    return true;
  } else { return false; }
}

function stringIncludesNumbers($value) {
  if (preg_match('/[0-9]/', $value)) {
    return true;
  } else { return false; }
}

function stringIncludesSpecialCharacters($value) {
  if (preg_match('/[!@#$%^&*(),.?":{}|<>]/', $value)) {
    return true;
  } else { return false; }
}
?>