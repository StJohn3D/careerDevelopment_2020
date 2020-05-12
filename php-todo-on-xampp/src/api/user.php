<?php
require_once('db.php');

// define("PASSWORD_DEFAULT", "1234");

function get_user() {
  $db = db_connect_open();

  $query = "SELECT p.person_id as id, p.person_username as userName FROM person p";
  $result = mysqli_query($db, $query);

  $rows = array();
  if(mysqli_num_rows($result) >= 1) {
    while($row = mysqli_fetch_array($result)){
      $rows[] = (object)array('id'=>$row['id'], 'userName'=>$row['userName']);
    }
  }

  print json_encode($rows);

  db_connect_close();
}

function user_login($userName, $password) {
  $db = db_connect_open();



  db_connect_close();
}

function user_add($userName, $password, $email, $firstName, $lastName) {
  $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
  $firstNameOrNull = $firstName ? "\"$firstName\"" : "NULL";
  $lastNameOrNull = $lastName ? "\"$lastName\"" : "NULL";
  
  $db = db_connect_open();
  
  $addPersonQuery = "INSERT INTO person(person_username, person_password, person_first_name, person_last_name) VALUES(\"$userName\", \"$encryptedPassword\", $firstNameOrNull, $lastNameOrNull)";

  $success = mysqli_query($db, $addPersonQuery);

  if($success) {
    $latest_id = mysqli_insert_id($db);
    return $latest_id;
  } else {
    return -1;
  }

  db_connect_close();
}

function user_access_key($userName, $email) {
  return password_hash("accessKeyFor-$userName-$email", PASSWORD_DEFAULT);
}

function user_authenticate() {
  if( isset($_COOKIE["userId"]) && isset($_COOKIE["accessKey"]) ) {
    echo "Welcome " . $_COOKIE["userId"] . "<br />";
  }
  else {
    header('Location: '.$uri.'/todoapp/login.php/');
    exit;
  }
}

?>