<?php

include_once 'dbconnect.php';
$query = mysqli_query($con,"INSERT INTO user (`first_name` , `last_name` , `gender` , `email`,`address` ,`phone`, `password`) VALUES  ('hello' , 'gdr' , 'sdg' , 'sgd','ghk' ,'2356', 'dfh')");
if (!$query) {
    echo "faliure";
}
else{ echo "Success"; }

?>
