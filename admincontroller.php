<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    getUser();
   
    //$stmt = $connection->query("INSERT INTO product_variants (product_id,sku,name,description,size,color,categories_id,quantity)values(1,$name,$discription,$categories_id,$price,$quantity) ");
}
function getUser(){
    global $connection;
    $row=$connection->query("SELECT first_name,email FROM users ");
    $result=$row->fetch_assoc(); 
    echo json_encode($result);
    
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cotegories'])) {
  
   
}