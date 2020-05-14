<?php
  require_once('./lib/fieldValidations.php');
  $passwordState = (object)array('valid'=>true, 'errorMessage'=>"");
  $passwordState = validatePassword("AAA");
?>
  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDo App</title>
</head>
<body>
  <main>
    <h1>ToDo App</h1>
    <section>
      <h1>Sign Up</h1>
      <form method="post" action="signup.php">
        <div class="form-control">
          <label for="userName">User Name</label>
          <input type="text" name="userName" id="userName" required aria-required="true" maxlength="55" value="<?php echo getFieldValue('userName') ?>"/>
        </div>
        <div class="form-control">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" required aria-required="true" minlength="4" maxlength="256" value="<?php echo getFieldValue('password') ?>"/>
        </div>
        <div class="form-control">
          <label for="password_confirm">Confirm Password <?php if(!$passwordState->valid) { echo ": <b>$passwordState->errorMessage</b>"; } ?></label>
          <input type="password" name="password_confirm" id="password_confirm" required aria-required="true" minlength="4" maxlength="256" value="<?php echo getFieldValue('password_confirm') ?>"/>
        </div>
        <div class="form-control">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required aria-required="true" maxlength="256" value="<?php echo getFieldValue('email') ?>"/>
        </div>
        <div class="form-control">
          <label for="firstName">First Name</label>
          <input type="text" name="firstName" id="firstName" aria-required="false" maxlength="256" value="<?php echo getFieldValue('firstName') ?>"/>
        </div>
        <div class="form-control">
          <label for="lastName">Last Name</label>
          <input type="text" name="lastName" id="lastName" aria-required="false" maxlength="256" value="<?php echo getFieldValue('lastName') ?>"/>
        </div>
        <input type="submit" name="submit" value="Sign Up"/>
      </form>
    </section>
    <section>
      <h1>Already a member?</h1>
      <a href="/todoapp/login.php">Login In</a>
    </section>
  </main>
</body>
</html>
<?php
require_once('./api/user.php');

if(isset($_POST['submit'])) {
  $password = $_POST['password'];
  $password_confirm = $_POST['password_confirm'];
  if ($password === $password_confirm) {
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
  
    $userId = user_add($userName, $password, $email, $firstName, $lastName);
  
    if ($userId > -1) {
      $timeToExpire = time() + (60 * 60); //60 seconds * 60 minutes = 1 hour
      $accessKey = user_access_key($userName, $email);
      setcookie("userId", $userId, $timeToExpire, "/", "", 0);
      setcookie("accessKey", $accessKey, $timeToExpire, "/", "", 0);
      header('Location: '.$uri.'/todoapp/index.php/');
      exit;
    }
  }
}
?>