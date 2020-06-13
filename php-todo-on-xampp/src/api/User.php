<?php
require_once('./db/LoginAttempt.php');
require_once('./db/Person.php');
require_once('./db/Email.php');

class User {
  private static function accessKey($userName, $userId) {
    return "accessKeyFor-$userName-$userId";
  }

  private static function setCookies($userName, $userId) {
    $encryptedAccessKey = password_hash(User::accessKey($userName, $userId), PASSWORD_DEFAULT);
    $timeToExpire = time() + (60 * 60); //60 seconds * 60 minutes = 1 hour
    setcookie("userId", $userId, $timeToExpire, "/", "", 0);
    setcookie("accessKey", $encryptedAccessKey, $timeToExpire, "/", "", 0);
  }

  private static function clearCookies() {
    $timeToExpire = time() - 60; //60 seconds in the past will invalidate and remove the cookies
    setcookie("userId", $userId, $timeToExpire, "/", "", 0);
    setcookie("accessKey", $encryptedAccessKey, $timeToExpire, "/", "", 0);
  }

  public static function logout() {
    User::clearCookies();
    header('Location: '.$uri.'/todoapp/login.php/');
  }

  public static function login($userNameOrEmail, $password) {
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $loginAttempt = new LoginAttempt($ipAddress);

    $personData = null;
    if (filter_var($userNameOrEmail, FILTER_VALIDATE_EMAIL)) {
      $personData = Person::getByEmailAddress($userNameOrEmail);
    } else {
      $personData = Person::getByUserName($userNameOrEmail);
    }

    if ($personData !== null) {
      if (password_verify($password, $personData->password)) {
        if ($loginAttempt->timeStamp === null) {
          // Good place to send an email about new login from unknown device with a link to reset password if it wasn't them.
        }
        $loginAttempt->set(true);
        User::setCookies($personData->userName, $personData->id);
        return true;
      }
    }
    
    $loginAttempt->set(false);
    return false;
  }
  
  public static function add($userName, $password, $email, $firstName, $lastName) {
    $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $newPersonId = Person::add($userName, $encryptedPassword, $firstName, $lastName);
  
    if($newPersonId > -1) {
      Email::add($email, $newPersonId);
    }

    return $newPersonId;
  }
  
  public static function authenticate() {
    if( isset($_COOKIE["userId"]) && isset($_COOKIE["accessKey"]) ) {
      $personData = Person::getById($_COOKIE["userId"]);
      if (password_verify(User::accessKey($personData->userName, $personData->id), $_COOKIE["accessKey"])) {
        // Reset the cookies to extend the session
        User::setCookies($personData->userName, $personData->id);
        return $personData;
      }
    }
    header('Location: '.$uri.'/todoapp/login.php/');
    exit;
  }
}

?>