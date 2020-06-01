<?php
  require_once('login-ctrl.php');
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
      <h1>First time?</h1>
      <a href="/todoapp/signup.php">Sign Up</a>
    </section>
    <section>
      <h1>Login</h1>
      <?php if($invalidLogin) { echo "<p class=\"invalid-message\">Invalid User Name or Password</p>"; } ?>
      <form method="post" action="login.php">
        <div class="form-control">
          <label for="user_name">User Name<?php
            if(!$userNameState->valid) { echo ": <b>$userNameState->errorMessage</b>"; }
          ?></label>
          <input type="text" name="user_name" id="user_name"
            required aria-required="true" maxlength="55"
            value="<?php echo $userName; ?>"
          />
        </div>
        <div class="form-control">
          <label for="password">Password<?php
            if(!$passwordState->valid) { echo ": <b>$passwordState->errorMessage</b>"; }
          ?></label>
          <input type="password" name="password" id="password"
            required aria-required="true" maxlength="256"
            value="<?php echo $password; ?>"
          />
        </div>
        <input type="submit" name="submit" value="Login"/>
      </form>
    </section>
  </main>
</body>
</html>