<?php 
include "config.php";
if($_SERVER['REQUEST_METHOD']=='GET'){
     $search = $_GET['search'];
     global $connection;
     $row=$connection->query("SELECT * FROM categories");
     $result= $row->fetch_assoc();
     
}



?>