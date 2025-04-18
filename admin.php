<?php 
session_start();

?>
<!DOCTYPE html>
<header><script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<title>admin</title>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../fevicon.ico">
</header>
<html>

<body>
    <form action="../controller/admincontroller.php" method="POST">
        <button type="submit" value="submit">get users </button>
    </form>
    <span id ='name'></span>
</body>
<script>
    $(document).ready(function() {
        $("form").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '../controller/admincontroller.php',
                method: 'GET',
                data: $("form").serialize(),
                dataType: 'json',
                success: function(data) {
                    
                document.getElementById('name').innerHTML=`${data.name}`;
                
                },
                error:function(erorr){
                    console.log('hi');
                }

            })
        })
    })
</script>

</html>