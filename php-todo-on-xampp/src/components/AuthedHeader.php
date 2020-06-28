<?php
require_once('./api/User.php');

if(isset($_POST['logout'])) {
  User::logout();
}

class AuthedHeader {
  public static function render($userData) {
    return <<<XML
      <label>
        $userData->userName
      </label>
      <form method="post">
        <input class="btn btn--light" type="submit" name="logout" value="Logout" />
      </form>
    XML;
  }
}

?>