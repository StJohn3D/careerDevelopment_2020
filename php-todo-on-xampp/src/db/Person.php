<?php
require_once('todo_db_connect.php');

class Person {
  public static function getById($userId) {
    $todoDb = todo_db_connect();
  
    $query = "SELECT
      p.person_username,
      p.person_first_name,
      p.person_last_name
      FROM person p
      WHERE p.person_id = $userId"
    ;
  
  
    if ($result = $todoDb->query($query)) {
  
      $rows = array();
  
      if($result->num_rows >= 1) {
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
          $rows[] = (object)array(
            'userName'=>$row['person_username'],
            'firstName'=>$row['person_first_name'],
            'lastName'=>$row['person_last_name']
          );
        }
      }
  
      print json_encode($rows);
  
      /* free result set */
      $result->free();
    }
  
    /* close connection */
    $todoDb->close();
  }
  
  public static function add($userName, $password, $firstName, $lastName) {
    $todoDb = todo_db_connect();
  
    $firstNameOrNull = $firstName ? "\"$firstName\"" : "NULL";
    $lastNameOrNull = $lastName ? "\"$lastName\"" : "NULL";
    
    $query = "INSERT INTO person(
        person_username,
        person_password,
        person_first_name,
        person_last_name
      )
      VALUES(
        \"$userName\",
        \"$password\",
        $firstNameOrNull,
        $lastNameOrNull
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
}

?>