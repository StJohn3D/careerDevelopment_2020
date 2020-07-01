<?php
function getFieldValue($fieldName, $defaultValue = "") {
  if(isset($_POST[$fieldName])) {
    return filter_input(INPUT_POST, $fieldName, FILTER_SANITIZE_STRING);
  } else {
    return $defaultValue;
  }
}
?>