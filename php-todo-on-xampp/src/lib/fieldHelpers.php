<?php
function getFieldValue($fieldName, $defaultValue = "") {
  if(isset($_POST[$fieldName])) {
    return $_POST[$fieldName];
  } else {
    return $defaultValue;
  }
}
?>