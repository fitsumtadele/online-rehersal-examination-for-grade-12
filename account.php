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
<!-- ------------------------------------------------------Navigation Bar ---------------------------------------------------------------------------------------- -->

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
<!-- ------------------------------------------------------Navigation Bar ---------------------------------------------------------------------------------------- -->


<!-- ------------------------------------------------------Navigation Bar ---------------------------------------------------------------------------------------- -->

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

<!-- ------------------------------------------------------User Profile ---------------------------------------------------------------------------------------- -->
      <?php  
      if(@$_GET['q']==1) {

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
        <td><b><a href="account.php?q=exam&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1"  style="margin:0px;background:#99cc32"><span class="fa fa-external-link-alt" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
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

<!-- ------------------------------------------------------User Profile ---------------------------------------------------------------------------------------- -->

<!-- ------------------------------------------------------exam start ---------------------------------------------------------------------------------------- -->
     
      <?php
        if(@$_GET['q']== 'exam' && @$_GET['step']== 2)
        {
          
        $eid=@$_GET['eid'];
        $sn=@$_GET['n'];
        $total=@$_GET['t'];

        echo '<script>alert("Test started")</script>';
        $res=mysqli_query($con,"SELECT * FROM exams WHERE eid='$eid' " );

        while($row=mysqli_fetch_array($res) )
        {
        $result=$row['exam_time'];
        $_SESSION['ename'] = $row['name'];
        }

        echo "<h1 style='display:none' id='storage'>".$result."</h1>";
        echo "<h1 style='display:none' id='eid'>".$eid."</h1>";

        echo'<p id="days"></p>
            <p id="hours"></p>
            <p id="mins"></p>
            <p id="secs"></p>
            <h2 id="end"></h2>
            <style>
        p {
          display: inline;
          font-size: 40px;
          margin-top: 0px;
        }
        </style>';

        echo '<div class="panel" style="margin:5%">';
        $i=0;
        $q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid'  " );
        $q2=mysqli_query($con,"SELECT count(*) FROM questions WHERE eid='$eid'  " );
        $rr=mysqli_fetch_array($q2);
        while($row=mysqli_fetch_array($q) )
        {
        $qns[$i]=$row['qns'];
        $qid[$i]=$row['qid'];
        $i++;
        }
        echo '<form action="account.php?q=result&eid='.$eid.'" method="POST"  class="form-horizontal"';
        /*
        for($x=0;$x<$rr[0];$x++)
          $wewe+= '&ans'.$x.'='.$[$x];

        $wewe+='" method="POST"  class="form-horizontal"';
        echo $wewe;
*/
        //echo '<form action="account.php?q=result&eid='.$eid.'" method="POST"  class="form-horizontal">
        //<br />';
        for($j=0;$j<$rr[0];$j++)
        {
          
            echo '<b>Question &nbsp;'.($j+1).'&nbsp;::<br />'.$qns[$j].'</b><br /><br />';
          $qq=mysqli_query($con,"SELECT * FROM optionss WHERE qid='$qid[$j]' " );
          
          while($row=mysqli_fetch_array($qq) )
          {
          $option=$row['option'];
          $optionid=$row['optionid'];
          echo '<input type="radio" name="ans'.$j.'" value="'.$optionid.'">'.$option.'<br /><br />';
          //echo '<script>alert("ans'.$j.'");</script>';
        }

        }
       
        echo'<br /><button type="submit" class="btn btn-primary"><span class="fa fa-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
        }


      //////////////////////////////////////////////////////////result display//////////////////////////////////////////////////////////////////////////
        if(@$_GET['q']== 'result' && @$_GET['eid']) 
        {
        $eid=@$_GET['eid'];
        $qeid=mysqli_query($con,"SELECT count(*) FROM questions WHERE eid='$eid'" )or die('Error167');
        $rr=mysqli_fetch_array($qeid);
        for($a=0;$a<$rr[0];$a++)
        {
          $xx='ans'.$a;
          $ans[$a]=$_POST[$xx];
          
        }
        $qtot=mysqli_query($con,"SELECT total FROM exams WHERE eid='$eid'" )or die('Error159');
        while($row=mysqli_fetch_array($qtot) )
        {
            $total=$row['total'];
        }
        $countRight=0;
        for($i=0;$i<$total;$i++)
        {
        $qaa=mysqli_query($con,"SELECT count(*) FROM answer WHERE ansid='$ans[$i]'" )or die('Error1500');
        $row=mysqli_fetch_array($qaa);
        if($row[0]>0)
        {
          $countRight++;
        }
      }
        //////////must edit for physics test
        $wrong=$total-$countRight;
        $ename=$_SESSION['ename'];
        $i=0;
        $q=mysqli_query($con,"INSERT INTO history (`email` , `eid` , `score` , `sahi`,`wrong` ,`date` , `ename` ) VALUES('$email','$eid' ,'$countRight','$countRight','$wrong',NOW(),'$ename')")or die('Error');
        

        $q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error15');
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
         //////////////////////////////////////////////////////////result display//////////////////////////////////////////////////////////////////////////
      ?>
      
<!-- ------------------------------------------------------exam end---------------------------------------------------------------------------------------- -->
  

<!-- ------------------------------------------------------history start ---------------------------------------------------------------------------------------- -->
  
      <?php
        if(@$_GET['q']== 2) 
        {
        $qh=mysqli_query($con,"SELECT * FROM history WHERE email='$email'  " )or die('Error');

        echo  '<div class="panel title">
        <table class="table table-striped title1" >
        <tr style="color:black"><td><b>S.N.</b></td><td><b>Exam</b></td><td><b>Date<b></td><td><b>Score</b></td>';
        $c=0;
        while($row=mysqli_fetch_array($qh) )
        {
        $eid=$row['eid'];
        $s=$row['score'];
        $w=$row['date'];
        $n=$row['ename'];


        $c++;
        echo '<tr><td>'.$c.'</td><td>'.$n.'</td><td>'.$w.'</td><td>'.$s.'</td></tr>';
        }
        echo'</table></div>';
        }

      ?>


<!-- ------------------------------------------------------history start ---------------------------------------------------------------------------------------- -->
  

</div>
</div>
</div>
</div>

</body>
</html>




<!-- ------------------------------------------------------Time calculation Script ---------------------------------------------------------------------------------------- -->
  
<script>
    var x = 1;//document.getElementById("storage").innerHTML ;
    // The data/time we want to countdown to
    var monthhh = new Date().getMonth;
    var dayyy= new Date().getDate;
    var interval = x * 1000 * 60 ;
    var countDownDate = new Date().getTime()+interval;

    var myfunc = setInterval(function() {

    var now = new Date().getTime();

    var timeleft = countDownDate - now;
    var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);
        
    // Result is output to the specific element
    //document.getElementById("days").innerHTML = days + "d "
    document.getElementById("hours").innerHTML = hours + "h " 
    document.getElementById("mins").innerHTML = minutes + "m " 
    document.getElementById("secs").innerHTML = seconds + "s " 
        
    // Display the message when countdown is over
    if (timeleft < 0) {
        clearInterval(myfunc);

        var temp = document.getElementById("eid").innerHTML;
        window.location = "account.php?q=result&eid="+temp;
    }
    }, 1000);
    </script>

<!-- ------------------------------------------------------Time calculation Script ---------------------------------------------------------------------------------------- -->
