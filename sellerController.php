<?php
include "config.php";
session_start();
$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $name = $_POST['product-name'];
    $description = $_POST['product-description'];
    $price = $_POST['product-price'];
    $quantity = $_POST['product-quantity'];
    $categories = $_POST['categories'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $sku = $_POST['sku'];
    global $connection;
   
    
     $row = $connection->query("SELECT * FROM categories WHERE name='$categories'");
    $categories_id = $row->fetch_assoc();

    $row1 = $connection->query("SELECT * FROM users WHERE email='$email'");
     $seller_data = $row1->fetch_assoc();

    $connection->query("INSERT INTO products (user_id, categories_id, name, description, quantity,price) VALUES ('{$seller_data['id']}', '{$categories_id['id']}', '$name', '$description', $quantity,$price)");

    $row = $connection->query("SELECT * FROM products WHERE user_id='{$seller_data['id']}' AND name='$name'");
     $result = $row->fetch_assoc();

    $connection->query("INSERT INTO product_variants (product_id, sku, name, description, size, color, quantity,price) VALUES ('{$result['id']}', '$sku', '$name', '$description', '$size', '$color', $quantity,$price)");
}
