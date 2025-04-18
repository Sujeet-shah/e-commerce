<?php 
$servername="localhost";
$username="phpmyadmin";
$userpassword="Phpmyadmin123!";
$dbname="e_commerce";


$connection = new mysqli($servername,$username,$userpassword,$dbname);


if($connection->connect_error){
    die("Connection failed: " . $connection->connect_error);
}
?>