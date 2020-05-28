<?php

function todo_db_connect() {
  $mysqli = new mysqli("localhost", "root", "", "todo_app");

  /* check connection */
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

  return $mysqli;
}

?>