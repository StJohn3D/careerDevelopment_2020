<?php
  require_once('signup-ctrl.php');
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
          <label for="user_name">User Name<?php
            if(!$userNameState->valid) { echo ": <b>$userNameState->errorMessage</b>"; }
          ?></label>
          <input type="text" name="user_name" id="user_name" required aria-required="true" maxlength="55"
            value="<?php echo $userName; ?>"
          />
        </div>
        <div class="form-control">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" required aria-required="true" minlength="4" maxlength="256"
            value="<?php echo $password; ?>"
          />
        </div>
        <div class="form-control">
          <label for="password_confirm">Confirm Password
            <?php if(!$passwordState->valid) { echo ": <b>$passwordState->errorMessage</b>"; } ?>
          </label>
          <input type="password" name="password_confirm" id="password_confirm" required aria-required="true" minlength="4" maxlength="256"
            value="<?php echo $passwordConfirm; ?>"
          />
        </div>
        <div class="form-control">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required aria-required="true" maxlength="256"
            value="<?php echo $email; ?>"
          />
        </div>
        <div class="form-control">
          <label for="first_name">First Name</label>
          <input type="text" name="first_name" id="first_name" aria-required="false" maxlength="256"
            value="<?php echo $firstName; ?>"
          />
        </div>
        <div class="form-control">
          <label for="last_name">Last Name</label>
          <input type="text" name="last_name" id="last_name" aria-required="false" maxlength="256"
            value="<?php echo $lastName; ?>"
          />
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