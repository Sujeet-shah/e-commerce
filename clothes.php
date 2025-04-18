<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="fevicon.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<style>
.card {
  display: grid;
  grid-template-columns: auto auto auto;
  padding: 10px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.price {
  color: grey;
  font-size: 22px;
}

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card button:hover {
  opacity: 0.7;
}
</style>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="./index.php">name</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li class="active"><a href="#">phone</a></li>
      <li class="active"><a href="#">clothes</a></li>
        </ul>
      </li>
 
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="./pages/signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="./pages/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
  
</div>


</body>
</html>

<?php 
include "../controller/config.php";
global $connection;


$row =$connection->query("SELECT *FROM products where categories_id=2");
$result =$row->fetch_assoc();
//$response = file_get_contents('https://fakestoreapi.com/products');
 //$product=json_decode($response,true);
//var_dump($product);
$row =$connection->query("SELECT * FROM products WHERE categories_id=2");


while ($product = $row->fetch_array()){
  

   //$row1 = $connection->query("SELECT product_variants.name,product_variants.price,product_variants.description,product_images.featured_image FROM  product_variants INNER JOIN product_images  ON product_variants.id=product_images.product_variant_id ");
   
   $product_id=$product['id'];
   $product_quantity= $product['quantity'];
   
   $row2 =$connection->query("SELECT id FROM product_variants where product_id='$product_id'");
   $product_variant= $row2->fetch_assoc();
   $product_variant_id=$product_variant['id'];
   $row3 = $connection->query("SELECT * from product_images WHERE product_variant_id='$product_variant_id'");
   $product_image= $row3->fetch_assoc();

  $image=$product_image['featured_image'];
   $product_name=$product['name'];
  $price =$product['price'];
   $description=$product['description'];
  print_r($product_variant_id);
  echo "<div class="."card".">";
    echo "<img src=".$image ."alt='product image' height='400' width='400'>";
    echo "<h1>".$product_name ."</h1>";
    if($product_quantity==0){
        echo "<h2 > Out of stock</h2>";
    }
    echo "<p class= 'price'>price=".$price ."</p>";
    echo "<p>".$description."</p>";
    echo "<form action='product-detail.php' method='GET'>";
    echo "<input type='hidden' name='id' value=".$product_variant_id.">";
    echo "<p><button type='submit'>Buy</button></p>";
    echo "</form>";
    echo "</div>";
    $result['count']--;
 }
 
 
 


?>

