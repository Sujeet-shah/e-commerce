<?php
session_start();
if(!isset($_SESSION['email'])){
  header('location:/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <title>Document</title>
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



  <div class="container d-flex ">
    <?php
    include "../controller/config.php";
    global $connection;
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      $id = trim($_GET['id']);
      $row =  $connection->query("SELECT product_variants.id,product_variants.name,product_variants.description,product_variants.quantity ,product_variants.price,product_images.featured_image as img FROM product_variants INNER join product_images ON product_variants.id= product_images.product_variant_id where product_variants.id='$id'");
      $product = $row->fetch_array();

    ?>
      <div class="container float-left">
        <img src="<?php echo $product['img'] ?>" alt="product" class="img-thumbnail">
      </div>
      <div class='card  ' style="width: 40%;">
        <div class='card-body'>
          <h4 class='card-title'><?php $product['name'] ?></h4>
          <img class='cart-imgcard-text'><?php echo $product['description'] ?> </p>
          <h5>price:<?php echo  $product['price'] ?><h5>
              <div class="container">
                <button class="btn btn-primary" id="minus">-</button>
                <input type="number" name="quantity" id="quantity" min="1" max="100" value="1">
                <button class="btn btn-primary" id="plus">+</button>
              </div>
              <?php if ($product['quantity'] == 0) {
              ?>
                <h5> Out of stock</h5>
              <?php
              }
              ?>
              <form>
                <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                <input type="hidden" name="email" value="<?php echo $_SESSION['email'] ?>">
                <button type="submit" class='btn btn-primary'>Add to cart</button>
              </form>

        </div>
      </div>


  </div>
<?php  } ?>
</body>
<script>
  // $(document).ready(function(){
  // $("#minus").click(fucntion(){
  //   $("#quantity").val()

  // })
  // })
  $(document).ready(function() {
    $('form').submit(function(e) {
      
      $.ajax({
        url:'../cart.controller.php',
        method:'POST',
        data:$('form').serialize(),
        dataType:'json'
      })

    })
  })
</script>

</html>