<?php
session_start();

?>
<!DOCTYPE html>
<html>
   
    <body>
       
        <form action="../controller/data.php" method="POST">
        <?php 
         echo $_SESSION['email'];
        ?>
            <label for="otp">otp:</label><br>
             <input type="hidden" name="action" value="changepassword">
            <input type="text" name="otp" id="otp" placeholder="otp"><br>
            <label for="password">enter new password:</label><br>
            <input type="text" name="new_password" id="new_password" placeholder=" new password"><br>
            <button type="submit">submit</button>
            
        </form>
    </body>
</html>