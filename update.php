<?php
include_once 'dbconnect.php';
session_start();
$email=$_SESSION['email'];

#########################################################feedback delete starts#####################################################################################
if(isset($_SESSION['email'])){
if(@$_GET['fdid']) {
$id=@$_GET['fdid'];
$result = mysqli_query($con,"DELETE FROM feedback WHERE feed_id='$id' ") or die('Error');
header("location:admin.php?q=3");
}
}


#########################################################feedback delete ends#####################################################################################

#########################################################remove exam starts#####################################################################################

if(isset($_SESSION['email'])){
if(@$_GET['q']== 'rmquiz') {
$eid=@$_GET['eid'];
$result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$qid = $row['qid'];
$r1 = mysqli_query($con,"DELETE FROM optionss WHERE qid='$qid'") or die('Error');
$r2 = mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
}
$r3 = mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
$r4 = mysqli_query($con,"DELETE FROM exams WHERE eid='$eid' ") or die('Error');
$r4 = mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error');

echo'<div id= "toadd" class="" >
                <div class=" w3-animate-zoom">
                  <div class="container" id="success" >
                      <div class="alert alert-success alert-dismissible fade show">
                          <strong>!</strong> Successfully Deleted!!
                          <P>
                          <button type="button"class="btn btn-primary align-self-center my-3" data-dismiss="alert"><a  href="admin.php?q=4  "><span aria-hidden="true"></span>&nbsp;OK</a></button></P>
                      </div>
                  </div>
                </div>
              </div>';
}
}


#########################################################remove exam ends#####################################################################################

#########################################################adding questions starts#####################################################################################

if(isset($_SESSION['email'])){
if(@$_GET['q']== 'addqns') {
$n=@$_GET['n'];
$eid=@$_GET['eid'];
$ch=@$_GET['ch'];

for($i=1;$i<=$n;$i++)
 {
  $qid=uniqid();
 $qns=$_POST['qns'.$i];
 $q3=mysqli_query($con,"INSERT INTO questions ( `qid` , `eid` ,`qns` , `choice` , `answer`) VALUES  ('$qid', '$eid' ,'$qns' , '$ch' , '$i')");
 $oaid=uniqid();
  $obid=uniqid();
$ocid=uniqid();
$odid=uniqid();
$a=$_POST[$i.'1'];
$b=$_POST[$i.'2'];
$c=$_POST[$i.'3'];
$d=$_POST[$i.'4'];
$qa=mysqli_query($con,"INSERT INTO optionss (`qid` , `option` , `optionid`) VALUES  ('$qid','$a','$oaid')") or die('Error61');
$qb=mysqli_query($con,"INSERT INTO optionss (`qid` , `option` , `optionid`) VALUES  ('$qid','$b','$obid')") or die('Error62');
$qc=mysqli_query($con,"INSERT INTO optionss (`qid` , `option` , `optionid`) VALUES  ('$qid','$c','$ocid')") or die('Error63');
$qd=mysqli_query($con,"INSERT INTO optionss (`qid` , `option` , `optionid`) VALUES  ('$qid','$d','$odid')") or die('Error64');
$e=$_POST['ans'.$i];
switch($e)
{
case 'a':
$ansid=$oaid;
break;
case 'b':
$ansid=$obid;
break;
case 'c':
$ansid=$ocid;
break;
case 'd':
$ansid=$odid;
break;
default:
$ansid=$oaid;
}


$qans=mysqli_query($con,"INSERT INTO answer (`ansid` , `qid`) VALUES  ('$ansid' , '$qid')") or die('Error65');

 }
header("location:login.html");
}
}


#########################################################adding questions ends#####################################################################################

#########################################################exam start phase 2 starts#####################################################################################
if(@$_GET['q']== 'exam' && @$_GET['step']== 2) {
$eid=@$_GET['eid'];
$sn=@$_GET['n'];
$total=@$_GET['t'];
$ans=$_POST['ans'];
$qid=@$_GET['qid'];
$ename=$_SESSION['ename'];


$q=mysqli_query($con,"SELECT * FROM  WHERE qid='$qid' " );

$q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid' " );
while($row=mysqli_fetch_array($q) )
{
$ansid=$row['ansid'];   
}
if($ans == $ansid)
{
$q=mysqli_query($con,"SELECT * FROM exams WHERE eid='$eid' " );
while($row=mysqli_fetch_array($q) )
{
$sahi=$row['sahi'];
}
if($sn == 1)
{
$q=mysqli_query($con,"INSERT INTO history (`email` , `eid` , `score` , `sahi`,`wrong` ,`date` , `ename` ) VALUES('$email','$eid' ,'0','0','0',NOW(),'$ename')")or die('Error');
}
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$r=$row['sahi'];
}
$r++;
$s++;

$q=mysqli_query($con,"UPDATE `history` SET `score`=$s, `sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');

} 
else
{
$q=mysqli_query($con,"SELECT * FROM exams WHERE eid='$eid' " )or die('Error129');

while($row=mysqli_fetch_array($q) )
{
$wrong=$row['wrong'];
}
if($sn == 1)
{
$q=mysqli_query($con,"INSERT INTO history (`email` , `eid` , `score` , `sahi`,`wrong` ,`date`, `ename` ) VALUES('$email','$eid' ,'0','0','0',NOW(), '$ename' )")or die('Error137');
}
$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong'];
}
$w++;
$q=mysqli_query($con,"UPDATE `history` SET `score`=$s, `wrong`=$w, `date`=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
}
if($sn != $total)
{
$sn++;
header("location:account.php?q=exam&step=2&eid=$eid&n=$sn&t=$total")or die('Error152');
}

else
{
header("location:account.php?q=result&eid=$eid");
}
}

#########################################################exam start phase 2 ends#####################################################################################

#########################################################exam restart starts#####################################################################################
if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) {
$eid=@$_GET['eid'];
$n=@$_GET['n'];
$t=@$_GET['t'];

$q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
}
$q=mysqli_query($con,"DELETE FROM `history` WHERE eid='$eid' AND email='$email' " )or die('Error184');

header("location:account.php?q=exam&step=2&eid=$eid&n=1&t=$t");
}


#########################################################exam restart ends#####################################################################################


#########################################################update account starts#####################################################################################

if(@$_GET['q']== 'edit' ) {
  
include_once 'dbconnect.php';
$name=$_SESSION['name'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  $password = md5($password);

//update database with out image

    $sql="UPDATE user SET first_name='$first_name',last_name='$last_name',email='$email', `address`='$address',
    phone='$phone', gender='$gender' WHERE  first_name ='$name'";
    if($con->query($sql)===true)
    {
        
       //update password on account table
        $sql="UPDATE user SET Password ='$password' WHERE  first_name ='$name'";
        if($con->query($sql)===true)
        {
            echo'<div id= "toadd" class="" >
                <div class=" w3-animate-zoom">
                  <div class="container" id="success" >
                      <div class="alert alert-success alert-dismissible fade show">
                          <strong>!</strong> account information updated !!
                          <P>
                          <button type="button"class="btn btn-primary align-self-center my-3" data-dismiss="alert"><a  href="edit.php"><span aria-hidden="true"></span>&nbsp;OK</a></button></P>
                      </div>
                  </div>
                </div>
              </div>';
        
    
        }
        else
        {
            echo'<div id= "toadd" class="show" >
      <div class=" w3-animate-zoom">
        <div class="container p-2" id="success" >
            <div class="alert alert-danger alert-dismissible fade show">
            <strong>!</strong> Error:'. $sql .' <br> ' . $conn->error.' !!
                <P>
                <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
            </div>
        </div>
      </div>
    </div>';
    return;
        }

    }
    else
    {
        echo'<div id= "toadd" class="show" >
      <div class=" w3-animate-zoom">
        <div class="container p-2" id="success" >
            <div class="alert alert-danger alert-dismissible fade show">
            <strong>!</strong> Error:'. $sql .' <br> ' . $conn->error.' !!
                <P>
                <button type="button" onclick="got_to_back()"class="btn btn-primary align-self-center my-3" data-dismiss="alert">OK</button></P>
            </div>
        </div>
      </div>
    </div>';
    return;
    }

#########################################################update account ends#####################################################################################
}
?>

