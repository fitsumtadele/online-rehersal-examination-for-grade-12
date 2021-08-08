<!DOCTYPE html>
<html>
<head>
<title>User Page</title>
	
    <link  rel="stylesheet" href="css/bootstrap.min.css"/>
    <link  href="fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet"/>
    <link  rel="stylesheet" href="css/bootstrap.grid.min.css"/>
	<link  rel="stylesheet" href="css/fontawesome.css"/>
    <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
    <link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/account.css">
    <link  rel="stylesheet" href="css/font.css">
    <script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/all.js" type="text/javascript"></script>
    <script src="fontawesome-free-5.15.3-web/js/all.js" type="text/javascript"></script>
   

 
  <script src="js/bootstrap.min.js"  type="text/javascript"></script>

</head>
<?php
include_once 'dbconnect.php';
?>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
 
  <a class="navbar-brand" href="#">ORE</a>

  <ul class="navbar-nav mr-auto">
  	<li <?php if(@$_GET['q']==1) echo'class="active"'; ?> ><a class="nav-link"  href="account.php?q=1"><span class="fa fa-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
	<li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a class="nav-link"  href="account.php?q=2"><span class="fa fa-list-alt" aria-hidden="true"></span>&nbsp;History</a></li>
    <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a class="nav-link"  href="account.php?q=3"><span class="fa fa-stats" aria-hidden="true"></span>&nbsp;Ranking</a></li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
    <?php
      include_once 'dbconnect.php';
      session_start();
      $email=$_SESSION['email'];
        if(!(isset($_SESSION['email']))){
      header("location:index.html");

      }
      else
      {
      $name = $_SESSION['name'];

      include_once 'dbconnect.php';
      echo '<span class="pull-right top title1" ><span class="log1"><span class="fa fa-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="account.php" class="log log1">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=index.html" class="log"><span class="fa fa-sign-out-alt" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
      }
    ?>
    </li>
  </ul>
</nav>

<div class="container">
<div class="row">

<div id="myprofile" class="col-lg-3  d-lg-block  collapse rounded textcolor shadow-lg  mt-4  ml-3 bg-white">

<h4 id="pro-text" class=" text-center font-weight-bolder"> <?php echo $name?></h5>
<hr class="text-secondary">

<div class="row">
  <i class="fas fa-user" style="height:106px;width:106px;margin-left:5rem"></i>
 
</div>
<div class="row  my-4">
  <button class=" mx-auto btn btn-primary text-light w-100 " href="edit.php" ><a href="edit.php" class="log log1">Edit</a><span class="mx-2 fas fa-pen"></span></button>
</div>

<hr class="text-secondary">
<div class="container-fluid px-0">
  <div class="row">
    <div class="col-sm px-0">
    <ul class=" list-unstyled">
      <li class="mx-auto textcolor text-center my-2">Info</li>
      
      <li class=" textcolor font-weight-bold small my-1"><span class="   fas fa-user-circle mx-2"></span> <?php echo $name?></li>
      <li class=" textcolor  font-weight-bold small my-1 " ><span class="  fas fa-envelope-square text-nowrap mx-2"></span><?php echo $email?>  </li>
      
    </ul>
   </div>


  </div>
</div>


</div> 


<div class="col-lg-7">

<?php if(@$_GET['q']==1) {

$result = mysqli_query($con,"SELECT * FROM exams") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr style="color:black"><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Type</b></td><td><b>Year</b></td><td><b>Time limit</b></td><td></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
  $name = $row['name'];
  $total = $row['total'];
  $type = $row['type'];
  $year = $row['year'];
  $time = $row['exam_time'];
  $eid = $row['eid'];
  $sahi = $row['sahi'];
  $wrong = $row['wrong'];
  $title = $row['name'];
$q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error');
$rowcount=mysqli_num_rows($q12);  
if($rowcount == 0){
  echo '<tr><td>'.$c++.'</td><td>'.$name.'</td><td>'.$total.'</td><td>'.$type.'</td><td>'.$year.'</td><td>'.$time.'&nbsp;min</td>
  <td><b><a href="account.php?q=exam&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="fa fa-external-link-alt" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
}
else
{
  
echo '<tr style="color:#99cc32"><td>'.$c++.'</td><td>'.$name.'&nbsp;<span title="This quiz is already solve by you" class="far fa-check-circle" aria-hidden="true"></span></td><td>'.$total.'</td><td>'.$type.'</td><td>'.$year.'</td><td>'.$time.'&nbsp;min</td>
<td><b><a href="update.php?q=quizre&step=25&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:red"><i class="fas fa-sync fa-spin" aria-hidden="true"></i></span>&nbsp;<span class="title1"><b>Restart</b></span></a></b></td></tr>';

}
}
$c=0;
echo '</table></div>';

}?>



<!--exam start-->
<?php
if(@$_GET['q']== 'exam' && @$_GET['step']== 2) {
$eid=@$_GET['eid'];
$sn=@$_GET['n'];
$total=@$_GET['t'];
$q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid'  " );
echo '<div class="panel" style="margin:5%">';
while($row=mysqli_fetch_array($q) )
{
$qns=$row['qns'];
$qid=$row['qid'];
echo '<b>Question &nbsp;'.$sn.'&nbsp;::<br />'.$qns.'</b><br /><br />';
}
$q=mysqli_query($con,"SELECT * FROM optionss WHERE qid='$qid' " );

echo '<form action="update.php?q=exam&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="form-horizontal">
<br />';

while($row=mysqli_fetch_array($q) )
{
$option=$row['option'];
$optionid=$row['optionid'];
echo'<input type="radio" name="ans" value="'.$optionid.'">'.$option.'<br /><br />';
}
echo'<br /><button type="submit" class="btn btn-primary"><span class="fa fa-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
}


//result display
if(@$_GET['q']== 'result' && @$_GET['eid']) 
{
$eid=@$_GET['eid'];
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error157');
echo  '<div class="panel">
<center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];

echo '
      <tr style="color:#99cc32"><td>right Answer&nbsp;<span class="fa fa-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr> 
    <tr style="color:red"><td>Wrong Answer&nbsp;<span class="fa fa-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
    <tr style="color:#66CCFF"><td>Score&nbsp;<span class="fa fa-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
}

echo '</table></div>';

}
?>
<!--exam end-->


<?php
//history start
if(@$_GET['q']== 2) 
{
$q=mysqli_query($con,"SELECT * FROM history WHERE email='$email'  " )or die('Error');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:black"><td><b>S.N.</b></td><td><b>Exam</b></td><td><b>Date<b></td><td><b>Score</b></td>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$eid=$row['eid'];
$s=$row['score'];
$w=$row['date'];
$names="";
$q23=mysqli_query($con,"SELECT * FROM exams WHERE  eid='$eid' " )or die('Error');
while($row=mysqli_fetch_array($q23) )
{
$names=$row['name'];
}
$c++;
echo '<tr><td>'.$c.'</td><td>'.$names.'</td><td>'.$w.'</td><td>'.$s.'</td></tr>';
}
echo'</table></div>';
}

?>



</div></div></div></div>

</body>
</html>