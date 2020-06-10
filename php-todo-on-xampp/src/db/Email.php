<?php
require_once('todo_db_connect.php');

class Email {
  public static function add($email, $personId) {
    $todoDb = todo_db_connect();
  
    $query = "INSERT INTO email_address(
        email_address,
        email_address_person_id
      )
      VALUES(
        \"$email\",
        $personId
      )
    ";
  
    $id = -1; //Default return -1 on failure
  
    if($todoDb->query($query) === TRUE) {
      $id = $todoDb->insert_id;
    }
  
    /* close connection */
    $todoDb->close();
  
    return $id;
  }

  public static function emailExists($email) {
    $todoDb = todo_db_connect();
  
    $query = "SELECT
      e.email_address
      FROM email_address e
      WHERE e.email_address = \"$email\""
    ;
  
    $result = $todoDb->query($query);


    $emailExists = $result->num_rows === 1;
  
    /* free result set */
    $result->free();
  
    /* close connection */
    $todoDb->close();

    return $emailExists;
  }
}

?>