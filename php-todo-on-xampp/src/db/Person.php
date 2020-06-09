<?php
require_once('todo_db_connect.php');

class PersonDTO {
  public $id = -1;
  public $userName = "";
  public $firstName = "";
  public $lastName = "";
  public $password = "";

  public function __construct($id, $userName, $password, $firstName, $lastName) {
    $this->id = $id;
    $this->userName = $userName;
    $this->password = $password;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
  }
}

class Person {
  public static function getById($userId) {
    $todoDb = todo_db_connect();
  
    $query = "SELECT
      p.person_username,
      p.person_password,
      p.person_first_name,
      p.person_last_name
      FROM person p
      WHERE p.person_id = $userId"
    ;
  
    $result = $todoDb->query($query);

    $personData = null;
  
    if ($result->num_rows === 1) {
      $row = $result->fetch_array(MYSQLI_ASSOC);

      $personData = new PersonDTO(
        $userId,
        $row['person_username'],
        $row['person_password'],
        $row['person_first_name'],
        $row['person_last_name']
      );
    }
  
    /* free result set */
    $result->free();
  
    /* close connection */
    $todoDb->close();

    return $personData;
  }

  public static function getByUserName($userName) {
    $todoDb = todo_db_connect();
  
    $query = "SELECT
      p.person_id,
      p.person_password,
      p.person_first_name,
      p.person_last_name
      FROM person p
      WHERE p.person_username = \"$userName\""
    ;
  
    $result = $todoDb->query($query);
    
    $personData = null;
  
    if ($result->num_rows === 1) {
      $row = $result->fetch_array(MYSQLI_ASSOC);

      $personData = new PersonDTO(
        $row['person_id'],
        $userName,
        $row['person_password'],
        $row['person_first_name'],
        $row['person_last_name']
      );
    }

    /* free result set */
    $result->free();
  
    /* close connection */
    $todoDb->close();

    return $personData;
  }

  public static function getByEmailAddress($emailAddress) {
    $todoDb = todo_db_connect();

    $query = "SELECT
      p.person_id,
      p.person_username,
      p.person_password,
      p.person_first_name,
      p.person_last_name
      FROM
      person p
      INNER JOIN
      email_address e
      ON p.person_id = e.email_address_person_id
      WHERE e.email_address = \"$emailAddress\""
    ;
    
    $result = $todoDb->query($query);
    
    $personData = null;

    if ($result->num_rows === 1) {
      $row = $result->fetch_array(MYSQLI_ASSOC);

      $personData = new PersonDTO(
        $row['person_id'],
        $row['person_username'],
        $row['person_password'],
        $row['person_first_name'],
        $row['person_last_name']
      );
    }

    /* free result set */
    $result->free();

    /* close connection */
    $todoDb->close();

    return $personData;
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

  public static function userNameExists($userName) {
    $todoDb = todo_db_connect();
  
    $query = "SELECT
      p.person_username
      FROM person p
      WHERE p.person_username = \"$userName\""
    ;
  
    $result = $todoDb->query($query);


    $userNameExists = $result->num_rows === 1;
  
    /* free result set */
    $result->free();
  
    /* close connection */
    $todoDb->close();

    return $userNameExists;
  }
}

?>