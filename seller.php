<!-- 

// session_start();
// if (empty($_SESSION['email'])) {
//   header('location:./login.php');
// }
// $response = parse_url('https://fakestoreapi.com/products');
// echo get$response;
// while($response['id']>0){
//   echo "<img src=".$response['image'] ."alt='product image' height='400' width='400'>";
//     echo "<h1>".$response['tittle'] ."</h1>";
//     echo "<h2>".$response['price'] ."</h2>";
//   $response--;
// }
// ?>

<!DOCTYPE html>
<html>
<header>
<title>seller</title>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../fevicon.ico">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</header>

<body>
  <h1>hi seller</h1>
 
  <form action="../controller/sellerController.php" method ="POST">
    <input type="text" name="product-name" id="product-name" placeholder="product-name">
    <input type="text" name="product-description" id="product-description" placeholder="product-description">
    <input type="number" name="product-price"  step="0.01" id="product-price" placeholder="product-price">
    <input type="number" name="product-quantity" id="product-quaintity" placeholder="product quantity">
    <select name="categories" id="product-categories">
      <option value="phone">phone</option>
      <option value="clothes">clothes</option>
    </select>
    <input type="text" name="discount" id="discount" placeholder="discount">
    <input type="text" name="color" id="product-quaintity" placeholder="color">
    <input type="text" name="size" id="product-quaintity" placeholder="size">
    <input type="text" name="sku" id="product-quaintity" placeholder="sku">
    <button type="submit" onclick="resetField()"> add product</button>

  </form>
</body>
<script>
  var q = document.getElementById('product-quaintity').value;
  console.log(q);
  $(document).ready(function() {
    $("form").submit(function(e) {
      var data = $("form").serialize();
      
    e.preventDefault();
      $.ajax({
        method:'POST',
        url:'../controller/sellerController.php',
        data: $('form').serialize(),
        dataType: 'json',
        success: function(data) {
         
        },
        error: function(error) {
          
        }
      })
    })
    
  })
  function resetField(){
    var form = document.getElementById("myForm");
    form.reset();
  }
</script>

</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <title>seller</title>
</head>
<body>
  <div class="container d-flex ">
    <div class="container shadow-lg p-3 mb-5 bg-white rounded">
      
 <h1>hhh</h1>
    </div>
      <div class="container shadow-lg p-3 mb-5 bg-white rounded">
<h1>jss</h1>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</html>