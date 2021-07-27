<?php
include_once 'dbconnect.php';
$ref=@$_GET['q'];
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$date=date("Y-m-d");
$feedback = $_POST['feedback'];
$q=mysqli_query($con,"INSERT INTO feedback (`email` , `subject` , `feedback` , `date`)  VALUES  ('$email' , '$subject', '$feedback' , '$date')")or die ("Error");
header("location:$ref?q=Thank you for your valuable feedback");
?>