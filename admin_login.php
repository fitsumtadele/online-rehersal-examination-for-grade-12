<?php
include_once 'dbConnect.php';
$ref=@$_GET['q'];
$email = $_POST['email'];
$password = $_POST['password']; 
$password=md5($password); 

$result = mysqli_query($con,"SELECT email FROM admin WHERE email = '$email' and `password` = '$password'") or die('Error');
$count=mysqli_num_rows($result);
if($count==1){
session_start();
if(isset($_SESSION['email'])){
session_unset();}
$_SESSION["name"] = 'Admin';
$_SESSION["email"] = $email;
header("location:admin.php");
}
else header("location:$ref?w=Warning : Access denied");
?>