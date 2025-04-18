<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>index</title>
  <link rel="icon" type="image/x-icon" href="../fevicon.ico">
</head>

<body>
  <nav class="navbar bg-light sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php">
        <img src="./fevicon.ico " alt="ecom" width="30px" height="30px" class="align-text-top"> ecomm
      </a>

      <form action="#" method="get" class="d-flex">
        <input type="search" class="">
        <button type="submit"> search</button>
      </form>
    </div>
  </nav>

  <div class="container-fluid">
    <img src="./fevicon.ico" width="100%" height="200px" alt="Responsive image">
  </div>

  <div class="d-flex flex-wrap ">
  <?php
  include "controller/config.php";
  global $connection;
  $response = file_get_contents('https://fakestoreapi.com/products');
  $product = json_decode($response, true);
  foreach ($product as $product) {
  ?>
  
    <div class='card shadow-lg p-3 mb-5 bg-white rounded ' style='width: 300px;'>
      <img class='cart-img--top' src='<?php echo $product['image'] ?>' alt='product'>
      <div class='card-body'>
        <h4 class='card-title'><?php $product_data['name'] ?></h4>";
        <img class='cart-imgcard-text'><?php echo $product['description'] ?> </p>
        <h5>price:<?php echo  $product['price'] ?><h5>
            <a href='#' class='btn btn-primary'>buy</a>
      </div>
    </div>
  <?php
  } ?>
</div>
  <?php
  $row = $connection->query("SELECT * FROM products");
  while ($product_data = $row->fetch_array()) {
    $product_id = $product_data['id'];
    $row = $connection->query("SELECT product_variants.id as id,product_images.featured_image as img FROM product_variants INNER join product_images ON product_variants.id= product_images.product_variant_id where product_variants.product_id='$product_id' ");
    $product_variant_data = $row->fetch_array();
  ?>
    <div class='card shadow-lg p-3 mb-5 bg-white rounded' style='width: 300px;'>
      <img class=' cart-img-top' src="<?php echo $product_variant_data['img'] ?>" alt='product'>
      <div class='card-body'>
        <h4 class='card-title'><?php echo $product_data['name'] ?></h4>
        <p class='card-text'> <?php echo $product_data['description'] ?> </p>
        <?php
        if ($product_data['quantity'] == 0) {
        ?>
          <h5> Out of stock</h5>
        <?php
        }
        ?>
        <h5>price:<?php echo $product_data['price'] ?><h5>
            <form action='./pages/product-detail.php' method='get'>
              <input type='hidden' name='id' value=" <?php echo $product_variant_data['id'] ?>">
              <button type='submit' class='btn btn-primary'>buy</a>
            </form>
      </div>
    </div>
  <?php } ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>



