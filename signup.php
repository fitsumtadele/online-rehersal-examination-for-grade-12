<?php
include_once 'dbconnect.php';
ob_start();
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$password = md5($password);


    $search = mysqli_query($con,"SELECT email FROM user WHERE email='$email'"); 
    $match  = mysqli_num_rows($search);
        if($match > 0){
            echo ("<script>alert('Email Already Registered!!!');</script>");
            
        }
        else{
            $q=mysqli_query($con,"INSERT INTO user (`first_name` , `last_name` , `gender` , `address`,`email` ,`phone`, `password`) VALUES  ('$first_name' , '$last_name' , '$gender' , '$address','$email' ,'$phone', '$password')");
            if ($q)
            {
            session_start();
            $_SESSION["email"] = $email;
            $_SESSION["name"] = $first_name;

            echo ("<script>alert('Email Already Registered!!!');
            location.href='index.html';</script>");
            
            }
        }
 

ob_end_flush();
?>