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
      <form method="post" action="login.php">
        <div class="form-control">
          <label for="userName">User Name</label>
          <input type="text" name="userName" id="userName" required aria-required="true" maxlength="55"/>
        </div>
        <div class="form-control">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" required aria-required="true" maxlength="256" />
        </div>
        <button type="submit">Login</button>
      </form>
    </section>
  </main>
</body>
</html>