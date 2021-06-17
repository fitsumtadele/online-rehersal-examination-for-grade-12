<?php
include_once 'dbconnect.php';
if(@$_GET['demail']) {
$demail=@$_GET['demail'];
$result = mysqli_query($con,"DELETE FROM user WHERE email='$demail' ") or die('Error');
header("location:admin.php?q=0");
}
?>