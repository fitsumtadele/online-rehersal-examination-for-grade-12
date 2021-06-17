<?php 
if(isset($_SESSION['email'])){
session_destroy();}
$ref= @$_GET['q'];
header("location:index.html");
?>