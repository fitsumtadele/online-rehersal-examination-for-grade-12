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
      <a class="nav-link" href="admin.php?q=1">Exam List</a>
    </li>
    <li class="nav-item" <?php if(@$_GET['q']==2) echo'class="active"'; ?>>
      <a class="nav-link" href="admin.php?q=3">Feedback</a>
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
      header("location:index.html");

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
    <td><a title="Delete User" href="delete_user.php?demail='.$email.'"><b><span class="fa fa-trash" s></span></b></a></td></tr>';
}
$c=0;
echo '</table></div></div>';

}?>


<?php if(@$_GET['q']==1) {

$result = mysqli_query($con,"SELECT * FROM exams") or die('Error');
echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Time limit</b></td><td><b>Year</b></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$name = $row['name'];
	$total = $row['total'];
	$type = $row['type'];
    $time = $row['exam_time'];
	$eid = $row['eid'];
  $year = $row['year'];

	echo '<tr><td>'.$c++.'</td><td>'.$name.'</td><td>'.$total.'</td><td>'.$time.'&nbsp;min</td><td>'.$year.'</td>
	<td><b><a href="#" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="fa fa-external-link-alt" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';

}
$c=0;
echo '</table></div></div>';

}
?>




<!--feedback start-->
<?php if(@$_GET['q']==3) {
$result = mysqli_query($con,"SELECT * FROM `feedback` ORDER BY `feedback`.`date` DESC") or die('Error');
echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Subject</b></td><td><b>Email</b></td><td><b>Date</b></td><td><b>Time</b></td><td><b>By</b></td><td></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$date = $row['date'];
  $date= date("d-m-Y",strtotime($date));
	$subject = $row['subject'];
	$email = $row['email'];
	$id = $row['id'];
	 echo '<tr><td>'.$c++.'</td>';
	echo '<td><a title="Click to open feedback" href="admin.php?q=3&fid='.$id.'">'.$subject.'</a></td><td>'.$email.'</td><td>'.$date.'</td>
	<td><a title="Open Feedback" href="admin.php?q=3&fid='.$id.'"><b><span class="fa fa-folder-open" aria-hidden="true"></span></b></a></td>';
	echo '<td><a title="Delete Feedback" href="update.php?fdid='.$id.'"><b><span class="fa fa-trash" aria-hidden="true"></span></b></a></td>

	</tr>';
}
echo '</table></div></div>';
}
?>
<!--feedback closed-->

<!--feedback reading portion start-->
<?php if(@$_GET['fid']) {
echo '<br />';
$id=@$_GET['fid'];
$result = mysqli_query($con,"SELECT * FROM feedback WHERE id='$id' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$subject = $row['subject'];
	$date = $row['date'];
	$date= date("d-m-Y",strtotime($date));
	$feedback = $row['feedback'];
	
echo '<div class="panel"<a title="Back to Archive" href="admin.php?q=3"><b><span class="fa fa-level-up" aria-hidden="true"></span></b></a><h2 style="text-align:center; margin-top:-15px;font-family: "Ubuntu", sans-serif;"><b>'.$subject.'</b></h1>';
 echo '<div class="mCustomScrollbar" data-mcs-theme="dark" style="margin-left:10px;margin-right:10px; max-height:450px; line-height:35px;padding:5px;"><span style="line-height:35px;padding:5px;">-&nbsp;<b>DATE:</b>&nbsp;'.$date.'</span>
<br />'.$feedback.'</div></div>';}
}?>
<!--Feedback reading portion closed-->



