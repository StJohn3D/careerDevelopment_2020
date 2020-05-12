<?php
define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "todo_app");

$dbConnection;

function db_connect_open() {
  global $dbConnection;
  $dbConnection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error());

  return $dbConnection;
}

function db_connect_close() {
  global $dbConnection;
  mysqli_close($dbConnection);
}
?>