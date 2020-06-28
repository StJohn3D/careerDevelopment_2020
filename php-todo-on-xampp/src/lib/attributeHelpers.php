<?php
  function getInvalidAttributes($valid) {
    return $valid ? "" : 'invalid aria-invalid="true"';
  }
?>