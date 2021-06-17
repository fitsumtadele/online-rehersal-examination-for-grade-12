<!DOCTYPE html>
<html>

    <head>

        <title>ORE || Admin Page </title>
        <link  rel="stylesheet" href="css/bootstrap.min.css"/>
        <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/all.css">
        <link  rel="stylesheet" href="css/font.css">
        <script src="js/jquery.js" type="text/javascript"></script>
        <link  rel="stylesheet" href="css/fontawesome.css"/>
        <link  href="fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet"/>

        <script src="js/bootstrap.min.js"  type="text/javascript"></script>

    </head>

<body  style="background:#eee;">



<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
 
  <a class="navbar-brand" href="#">ORE</a>

  <ul class="navbar-nav mr-auto">
  <li class="nav-item" <?php if(@$_GET['q']==0) echo'class="active"'; ?>>
      <a class="nav-link" href="admin.php?q=0">User</a>
    </li>
    <li class="nav-item" <?php if(@$_GET['q']==1) echo'class="active"'; ?>>
      <a class="nav-link" href="admin.php?q=1">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Feedback</a>
    </li>

    <li class="nav-item dropdown float-right <?php if(@$_GET['q']==3 || @$_GET['q']==4) echo'active"'; ?>">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Exam
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="addexam.php?q=4">Add Exam</a>
        <a class="dropdown-item" href="#">Remove Exam</a>
      </div>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
    <?php
      include_once 'dbConnect.php';
      session_start();
      $email=$_SESSION['email'];
        if(!(isset($_SESSION['email']))){
      header("location:index.php");

      }
      else
      {
      $name = $_SESSION['name'];;

      include_once 'dbConnect.php';
      echo '<span class="pull-right top title1" ><span class="log1"><span class="fa fa-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="account.php" class="log log1">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=index.html" class="log"><span class="fa fa-sign-out-alt" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
      }
    ?>
    </li>
  </ul>
</nav>


<div class="container">
<div class="row">
<div class="col-md-12">



<!-- this is the user list part  -->
<?php if(@$_GET['q']==0) {
echo '<h1> List Of Users';
$result = mysqli_query($con,"SELECT * FROM user") or die('Error');
echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Name</b></td><td><b>Gender</b></td><td><b>address</b></td><td><b>Email</b></td><td><b>Mobile</b></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
    $name = $row['first_name'];
    $phone = $row['phone'];
    $gender = $row['gender'];
    $email = $row['email'];
    $address = $row['address'];

    echo '<tr><td>'.$c++.'</td><td>'.$name.'</td><td>'.$gender.'</td><td>'.$address.'</td><td>'.$email.'</td><td>'.$phone.'</td>
    <td><a title="Delete User" href="delete_user.php?demail='.$email.'"><b><span class="fa fa-trash" aria-hidden="true"></span></b></a></td></tr>';
}
$c=0;
echo '</table></div></div>';

}?>


<?php if(@$_GET['q']==1) {

$result = mysqli_query($con,"SELECT * FROM exams") or die('Error');
echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Time limit</b></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$name = $row['name'];
	$total = $row['total'];
	$type = $row['type'];
    $time = $row['exam_time'];
	$eid = $row['eid'];

	echo '<tr><td>'.$c++.'</td><td>'.$name.'</td><td>'.$total.'</td><td>'.$time.'&nbsp;min</td>
	<td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';

}
$c=0;
echo '</table></div></div>';

}

?>




