
<html>
    
    <head>
        <title>Edit Page</title>
        <link  rel="stylesheet" href="css/bootstrap.min.css"/>
        <link  href="css/all.css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/main.css">
        <link  rel="stylesheet" href="css/bootstrap.grid.min.css"/>
        <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/login.css">
        <link  rel="stylesheet" href="css/font.css">
        <link  rel="stylesheet" href="css/index.css">
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <link  rel="stylesheet" href="css/fontawesome.css"/>
        <link  href="fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet"/>

    </head>
          <?php
          include_once 'dbconnect.php';
          ?>
          <?php 
            session_start();
       $name = $_SESSION['name'];
        $result = mysqli_query($con,"SELECT * FROM user Where `first_name`='$name'") or die('Error');
        while($row = mysqli_fetch_array($result)) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $gender = $row['gender'];
        $email = $row['email'];
        $address = $row['address'];
        $phone = $row['phone'];
        $password = $row['password'];
        $password = md5($password);
    }
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
           
      <div class="container-fluid  " id="edit_profile" >
        <div class="container rounded bg-light shadow-lg ">
          <div class="row ">

            <div class="col-lg-12 ">
              <form name="update_client"  class =" py-3 " method ="POST" action="update.php?q=edit" enctype="multipart/form-data">

                <div class="form-group py-0">
                  <div class=row>
                    <div class="form-group col-lg  py-2">
                        <label for="fullname" class="font-weight-bolder">Firstname:</label>
                        <input type="text" class="form-control w-100"  onkeyup='fname_validation("update_client")' value="<?php echo $first_name?>" placeholder="Enter firstname" id="cfirstname" name="first_name" required>
                    </div>
                  </div>  
                    <div class="form-group col-lg py-2">
                        <label for="fullname" class="font-weight-bolder">Last name:</label>
                        <input type="text" class="form-control w-100 " onkeyup='lname_validation("update_client")' value="<?php echo $last_name?>" placeholder="Enter lastname" id="clastname" name="last_name" required>
                    </div>
                </div>
                <div class="form-group py-0">
                  <div class=row>
                    <div class="form-group col-lg  py-2">
                      <label for="pwd" class ="font-weight-bolder">Password:</label>
                      <input type="password"  value="<?php echo $password?>" class="mx-auto form-control w-100 " onblur='validation_Cpassword("update_client",0)' placeholder="Enter password" id="cpwd" name="password" required>
                      <span id="pass_location" class= " pass_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                    </div>

                    <div class="form-group col-lg py-2">
                      <label for="pwd" class ="font-weight-bolder">re-Password:</label>
                      <input type="password"   value="<?php echo $password?>" class="mx-auto form-control w-100 "  onblur='validation_Cpassword("update_client",0)' placeholder="re Enter your password" id="crepwd" name="repassword" required>
                      <span id="repass_location" class=" repass_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                    </div>
                  </div>
                </div>
                <div class="form-group  py-2">
                    <label for="email" class ="font-weight-bolder">Email:</label>
                    <input type="email" value="<?php echo $email?>" class=" mx-auto form-control w-100 " onblur='validation_Cemail("update_client",0)'  placeholder="Enter email" id="cemail" name="email" required>
                    <span id="email_location"class="email_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                </div>
                <div class="form-group  py-2">
                  <label for="phone" class ="font-weight-bolder">Phone Number:</label>
                  <input type="phone" value="<?php echo $phone?>" class=" mx-auto form-control w-100 "   placeholder="Enter phone" id="phone" name="phone" required>
                  <span id="phone_location"class="phone_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                </div>
                <div class="form-group  py-2">
                  <label for="address" class ="font-weight-bolder">Address:</label>
                  <input type="address" value="<?php echo $address?>" class=" mx-auto form-control w-100 "   placeholder="Enter address" id="address" name="address" required>
                  <span id="address_location"class="address_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                </div> 
                <div class="form-group  py-2">
                  <label for="gender" class ="font-weight-bolder">Gender:</label>
                  <input type="text" value="<?php echo $gender?>" class=" mx-auto form-control w-100 "   placeholder="Enter gender" id="gender" name="gender" required>
                  <span id="gender_location"class="address_location btn bg-danger fa fa-warning py text-white my-2 font-weight-bolder" style="display :none;"></span>
                </div>  
                <div class=" container d-flex flex-row-reverse ">
                <input type ="submit"  name="update_Client" value=" update " style="width: 100px;"  class=" signups mx-4 btn btn-success my-4">  
                </div>  
                 
              </form>
           </div>
        </div>
      </div> -->
    </body>
</html>