<?php 
session_start();
if(!isset($_COOKIE['session_id'])){
    header('location:./login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>cart</title>
</head>
<body>


<nav class="navbar bg-light sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php">
        <img src="../fevicon.ico " alt="ecom" width="30px" height="30px" class="align-text-top"> ecomm
      </a>

      <form action="#" method="get" class="d-flex">
        <input type="search" class="">
        <button type="submit"> search</button>
      </form>
    </div>
</nav>

<div class="container  ">
  <?php 
  include "../controller/config.php";
  global $connection;
  if($_SERVER['REQUEST_METHOD']=='GET'){
    $id =trim($_GET['id']);
    $connection->query("INSERT into cart(product_variant_id,user_id,quantity)values('$user_id','$id','$quantity')");
    $row= $connection->query("SELECT product_variants.id, product_variants.name,product_variants.description,cart.quantity,product_variants.price from cart INNER join product_variants on product_variants.id=cart.product_variant_id where user_id='$id' ");
   while($data=$row->fetch_array()){
    

   }
 }?>







</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

</html>