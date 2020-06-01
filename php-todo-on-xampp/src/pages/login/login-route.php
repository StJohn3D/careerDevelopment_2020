<?php
  require_once('./db/LoginAttempt.php');
  $ipAddress = $_SERVER['REMOTE_ADDR'];
  $loginAttempt = new LoginAttempt($ipAddress);

  $failedCountMax = 5;

  if ($loginAttempt->timeStamp === null || $loginAttempt->failedCount < $failedCountMax) {
    require_once('login-form.php');
  } else {
    $timeStampNow = new DateTime();
    $timeStampLastAttempt = new DateTime($loginAttempt->timeStamp);

    $dateInterval = $timeStampLastAttempt->diff($timeStampNow);

    //https://www.php.net/manual/en/class.dateinterval.php
    // use i to test minutes and d to use days
    $daysSinceLastFailedAttempt = $dateInterval->d;

    if ($daysSinceLastFailedAttempt > 0) {
      //This does not log the user in.
      //It just Resets failedCount to 0 since it's been at least 24 hours since the last failed attempt.
      $loginAttempt->set(true);

      //Load the form
      require_once('login-form.php');
    } else {
      require_once('login-locked.php');
    }
  }



?>
