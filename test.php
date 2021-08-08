<?php 
        include_once 'dbconnect.php';
        $result = mysqli_query($con,"SELECT * FROM user") or die('Error');
        while($row = mysqli_fetch_array($result)) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $gender = $row['gender'];
        $email = $row['email'];
        $address = $row['address'];
        $phone = $row['phone'];
        $password = $row['password'];
        $password = md5($password);
?>