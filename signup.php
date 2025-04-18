<!DOCTYPE html>
<html>
<head>
<title>signup</title>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../fevicon.ico">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Optional Bootstrap JS (for components like modals, dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<link rel="stylesheet" href="style.css">
</head>



<body>
   

       
            <form method="post" >
            <input type="hidden" name = "action" value="signup">
                <label id='first_name'> first name: </label><br>
                <input type='text' name='first_name' placeholder="first  name "> <br>

                <span id='firstname'></span><br>

                <label id='middle_name'> middle name(Optional): </label><br>
                <input type='text' name='middle_name' placeholder=" middle name "> <br>


                <label id='last_name'> last name: </label><br>
                <input type='text' name='last_name' placeholder=" last name "> <br>
                <span id='lastname'></span><br>

                <label id='email'> email: </label><br>
                <input type='email' name='email' id="email" placeholder="enter your email"><br>
                <span id='_email'></span><br>

                <label id='password'> password: </label><br>
                <input type='text' name='password' placeholder="enter your password"><br>
                <span id='originalpassword'></span><br>

                <label id='confirm_password'> confirm password: </label><br>
                <input type='text' name='confirm_password' placeholder="confirm  password"><br>
                <span id='confirmpassword'></span><br>

                <label> select user type: <br>
                    <select name='role' id='role'>
                        <option value="3">user</option>
                        <option value="2">seller</option>
                    </select>
                </label>

                <br><button type='submit' class="btn btn-dark"> create account</button>
            </form>
    
    <a href="login.php"> login here...</a>
</body>
<script>
    
    $(document).ready(function() {
        $('form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '../controller/data.php',
                method: 'post',
                data: $("form").serialize(),
                dataType: 'json',

                success: function(data) {

                    if (data.first_name !== undefined) {
                        document.getElementById("firstname").innerHTML = `${data.first_name}  `;
                    }
                    if (data.last_name !== undefined) {
                        document.getElementById("lastname").innerHTML = `${data.last_name} `;
                    }
                    if (data.password !== undefined) {
                        document.getElementById("originalpassword").innerHTML = `${data.password}  `;
                    }
                    if (data.email !== undefined) {

                        document.getElementById("_email").innerHTML = `${data.email}  `;
                    }
                    if (data.confirmpassword !== undefined) {

                        document.getElementById("confirmpassword").innerHTML = `${data.confirmpassword}  `;
                    }

                   

                },
                error: function(error) {
                    window.location.href = 'http://localhost:3000/pages/login.php';
                }



            })

        })

    })

    // var password = document.getElementById('password');
    // var confirm_password = document.getElementById('confirm_password');
    // if (password != confirm_password) {
    //     alert('password does not match');

    // }
</script>

</html>