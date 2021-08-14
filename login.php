<?php
session_start();
if(isset($_SESSION["email"])){
session_destroy();
}
include_once 'dbconnect.php';
$ref=@$_GET['q'];
$email = $_POST['email'];
$password = $_POST['password'];
$password=md5($password); 

$result = mysqli_query($con,"SELECT first_name FROM user WHERE email = '$email' and `password` = '$password'") or die('Error');
$count=mysqli_num_rows($result);

if($count==1){
	while($row = mysqli_fetch_array($result)) {
		$name = $row['first_name'];
	}
	$_SESSION["name"] = $name;
	$_SESSION["email"] = $email;

header("location:account.php");
}

else
echo '<script>alert("Wrong Password")</script>';

?>