<?php 
session_start();

if($_SERVER['REQUEST_METHOD']=='POST'){
$email=$_SESSION['email'];
$id=$_POST['id'];
}
?>