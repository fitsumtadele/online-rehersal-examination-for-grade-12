<!DOCTYPE html>
<html>

    <head>

        <title>ORE || Admin Page </title>
        <link  rel="stylesheet" href="css/bootstrap.min.css"/>
        <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
        <link rel="stylesheet" href="css/main.css">
        <link  rel="stylesheet" href="css/font.css">
        <script src="js/jquery.js" type="text/javascript"></script>

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
<?php
include_once 'dbconnect.php';
if(@$_GET['q']==4 && !(@$_GET['step']) ) {
echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Exam Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">   <form class="form-horizontal title1" name="form" action="addexam.php?q=addexam"  method="POST">
<fieldset>


<div class="form-group">
  <label class="col-md-12 control-label" for="name"></label>  
  <div class="col-md-12">
  <input id="name" name="name" placeholder="Enter Exam title" class="form-control input-md" type="text">
    
  </div>
</div>



<div class="form-group">
  <label class="col-md-12 control-label" for="total"></label>  
  <div class="col-md-12">
  <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number">
    
  </div>
</div>

<div class="form-group">
    <div class="maxl col-md-12">
        <label class="radio inline"> 
            <input type="radio" id="type" name="type" value="Natural" checked>
            <span>Natural</span> 
        </label>
        <label class="radio inline ml-5"> 
            <input type="radio" id="type" name="type" value="Social">
            <span>Social</span> 
        </label>
    </div>
</div>



<div class="form-group">
  <label class="col-md-12 control-label" for="time"></label>  
  <div class="col-md-12">
  <input id="time" name="time" placeholder="Enter time limit for test in minute" class="form-control input-md" min="1" type="number">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-12 control-label" for="time"></label>  
  <div class="col-md-12">
  <input id="year" name="year" placeholder="Enter the year of the exam" class="form-control input-md" min="1" type="number">
    
  </div>
</div>


<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';



}
?>



<?php
if(@$_GET['q']==4 && (@$_GET['step'])==2 ) {
echo ' 
<div class="row">
<span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="update.php?q=addqns&n='.@$_GET['n'].'&eid='.@$_GET['eid'].'&ch=4 "  method="POST">
<fieldset>
';
 
 for($i=1;$i<=@$_GET['n'];$i++)
 {
echo '<b>Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
  <div class="col-md-12">
  <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..."></textarea>  
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'1"></label>  
  <div class="col-md-12">
  <input id="'.$i.'1" name="'.$i.'1" placeholder="Enter option a" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'2"></label>  
  <div class="col-md-12">
  <input id="'.$i.'2" name="'.$i.'2" placeholder="Enter option b" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'3"></label>  
  <div class="col-md-12">
  <input id="'.$i.'3" name="'.$i.'3" placeholder="Enter option c" class="form-control input-md" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'4"></label>  
  <div class="col-md-12">
  <input id="'.$i.'4" name="'.$i.'4" placeholder="Enter option d" class="form-control input-md" type="text">
    
  </div>
</div>
<br />
<b>Correct answer</b>:<br />
<select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="form-control input-md" >
   <option value="a">Select answer for question '.$i.'</option>
  <option value="a">option a</option>
  <option value="b">option b</option>
  <option value="c">option c</option>
  <option value="d">option d</option> </select><br /><br />'; 
 }
    
echo '<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></div>';



}
?>
</div>
</div>
</div>
<?php
include_once 'dbconnect.php';
if(@$_GET['q']== 'addexam') {
$name = $_POST['name'];
$total = $_POST['total'];
$time = $_POST['time'];
$type = $_POST['type'];
$year = $_POST['year'];
$id=uniqid();
$q3=mysqli_query($con,"INSERT INTO exams (`eid` , `exam_time` , `name` , `date_stamp`,`total` ,`type` ,`year`) VALUES  ('$id' , '$time' , '$name' , NOW() ,'$total','$type','$year' )")  or die('Error00');

header("location:addexam.php?q=4&step=2&eid=$id&n=$total");
}
?>