<!doctype html>
<html lang="de">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>\[T]/</title>
  <base href="http://ds.fahrzeugatelier.de">

  <link rel="stylesheet" href="/css/layout.css" type="text/css" media="screen">
  <link rel="stylesheet" href="/css/login.css" type="text/css" media="screen">
</head>

<body>

  <!-- Login -->
  <div class="aidscontent">
    <div id="flex-container-login">
      <div class="flex-item-login">
        <form action="/" method="post">
          <div class="imgcontainer">
            <img src="/img/WeirdTepidChital-max-1mb.gif" alt="Bonfire" class="avatar">
          </div>

          <div class="login">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button type="submit">Login</button>

            <div class="error">
              <?php
              if ( !empty( $error ) )echo $error;
              ?>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>