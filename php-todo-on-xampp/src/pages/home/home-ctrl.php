<?php
  if(isset($_POST['logout'])) {
    User::logout();
  }
?>