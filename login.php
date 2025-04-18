<?php
session_start();


?>

<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../fevicon.ico">
</head>

<body>



















    <form action="../controller/data.php" method="POST">
        <div class="mb-3">
            <input type="hidden" name="action" value="login">

            <label for="email" class="form-label">email address</label>
            <input type='text' name='email' placeholder="enter your email" class="form-text"><br>
            <label for="password" class="form-label"> enter your password</label>
            <input type='text' name='password' class="form-text" placeholder="enter your password"><br>
            <button type='submit' name='submit' class="btn btn-primary">login</button>
        </div>
    </form>

    <a href="signup.php">create acoount !</a>
    <br>
    <a href="forget.php">forget password !</a>

</body>

</html>