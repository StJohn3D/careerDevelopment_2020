<?php
function getFieldValue($fieldName) {
  if(isset($_POST[$fieldName])) {
    return $_POST[$fieldName];
  } else {
    return "";
  }
}
?>