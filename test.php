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
























<!-- 
<div class="row">
        
                  
                    
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover table-sortable">
                            <h4><i class="fa fa-angle-right"></i> All User Details 
                            <div class="search">
                            <form class="search1">
                            <input type="text" name="search1" placeholder="Search..." >
                            </form>
                            </div></h4>
                            <hr>
                              <thead>
                              <tr>
                                  <th>No.</th>
                                  <th class="hidden-phone">First Name</th>
                                  <th> Gender</th>
                                  <th> Email</th>
                                  <th>Contact no.</th>
                                  <th>Address</th>
                              </tr>
                              </thead>
                              <tbody id='tbody'>
                              <?php $ret=mysqli_query($con,"SELECT * FROM user");
                $cnt=1;
                while($row=mysqli_fetch_array($ret))
                {?>
                  
                              <tr>
                             
                              <td><?php echo $cnt;?></td>
                                  <td><?php echo $row['first_name'];?></td>
                                  <td><?php echo $row['gender'];?></td>
                                  <td><?php echo $row['email'];?></td>
                                   <td><?php echo $row['phone'];?></td>  
                                    <td><?php echo $rows['address'];?></td>
                                  <td>
                                     
                                     <!-- <a href="update-profile.php?id="> 
                                     <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a> -->
                                     <a href="delete_user.php?demail=<?php echo $row['email'];?>" > 
                                     <button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><i class="fa fa-trash-o "></i></button></a>
                                  </td>
                              </tr>
                              <?php $cnt=$cnt+1; }?>
                             
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
 -->




























 