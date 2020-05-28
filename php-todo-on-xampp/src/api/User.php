<?php
require_once('./db/Person.php');
require_once('./db/Email.php');

class User {
  public static function login($email, $password) {

  }
  
  public static function add($userName, $password, $email, $firstName, $lastName) {
    $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $newPersonId = Person::add($userName, $encryptedPassword, $firstName, $lastName);
  
    if($newPersonId > -1) {
      Email::add($email, $newPersonId);
    }

    return $newPersonId;
  }
  
  public static function accessKey($userName, $email) {
    return password_hash("accessKeyFor-$userName-$email", PASSWORD_DEFAULT);
  }
  
  public static function authenticate() {
    if( isset($_COOKIE["userId"]) && isset($_COOKIE["accessKey"]) ) {
      echo "Welcome " . $_COOKIE["userId"] . "<br />";
      Person::getById($_COOKIE["userId"]);
    }
    else {
      header('Location: '.$uri.'/todoapp/login.php/');
      exit;
    }
  }
}

?>