<?php
session_start();
?>
<!DOCTYPE html>
<head>
<title>forget</title>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../fevicon.ico">
</head>
<body>
    <html>

    <form action="../controller/data.php" method="POST">
        <input type="hidden" name = "value" value="forget">
        <input type="email" name="email" id="email" placeholder="enter your email"><br>
        <button type="submit" > forget password</button>

    </form>
</body>
</html>