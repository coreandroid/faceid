 <?php
   include 'conn.php';
    
    
if(!isset($_SESSION['LogId'])){

  header('location:login.php');

}
  
   $result = mysqli_query($conn,"select * from users where Id=$_GET[Id]");

  $Data=mysqli_fetch_array($result,MYSQLI_ASSOC);


   if(isset($_POST['save'])){

     if(intval($_POST['Id']) > 0){ // if hash id then update
    
    if(isset($_POST['password']) && $_POST['password'] != ""){
     $stmt = $conn->prepare("UPDATE users set Name=?,Username=?,Password=?,Role=? where Id=?");
     $stmt->bind_param("ssssi", $name, $username, $password,$role,$_POST['Id']);
     }else{

     $stmt = $conn->prepare("UPDATE users set Name=?,Username=?,Role=? where Id=?");
     $stmt->bind_param("sssi", $name, $username,$role,$_POST['Id']);

     }

     $name = $_POST['name'];
     $username = $_POST['username'];
     $role = $_POST['role'];
     $password = $_POST['password'];

     if($_SESSION['LogRole'] == 'Teacher') $_POST['role'] = $_SESSION['LogRole'];

     $stmt->execute();

     $stmt->close();
     $conn->close();
 echo "<script>alert('Profile is Updated');window.location.assign('user.php');</script>";
     }else { //if not then add

     $stmt = $conn->prepare("INSERT INTO users (Name, Username, Password,Role) VALUES (?, ?, ?,?)");
     $stmt->bind_param("ssss", $name, $username, $password,$role);

     $name = $_POST['name'];
     $username = $_POST['username'];
     $role = $_POST['role'];
     $password = $_POST['password'];

     $stmt->execute();
  
   
     $stmt->close();
     $conn->close();
    echo "<script>alert('Profile is Added');window.location.assign('user.php');</script>";

  
     }

   }

   ?>

<?php include 'shared/header.php';?>
<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ===============================<??>=============================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
       <?php include 'shared/nav.php';?>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include 'shared/sidebar.php';?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h2 class="page-title">Section</h2>


                        <br> 



                    </div>
                    
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title">form</h3> 
                            <form class="form-horizontal form-material" method="post">
                                <div class="form-group">
                                    <label class="col-md-12">Name</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Section name" value="<?= $Data['Name'];?>" name="name" class="form-control form-control-line"> </div>
                                        <input type="hidden"  name="Id" value="<?= $Data['Id'];?>"   class="form-control form-control-line">
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-md-12">Username</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Username" value="<?= $Data['Username'];?>" name="username" class="form-control form-control-line"> </div>
                                      
                                </div>
    <?php  if($_SESSION['LogRole'] == "admin") { ?>
                                  <div class="form-group">
                                    <label class="col-md-12">Role</label>
                                    <div class="col-md-12">
                                        <select  id="role"  name="role" class="form-control form-control-line">
                                          
                                        <option>Teacher</option>
                                        <option>admin</option>

                                        </select>

                                         </div>
                                      
                                </div>
<?php } ?>
                                 <div class="form-group">
                                    <label class="col-md-12">Password</label>
                                    <div class="col-md-12">
                                        <input type="password" placeholder="Enter password"   name="password" class="form-control form-control-line"> </div>
                                      
                                </div>



                                 <div class="form-group">
                                    <label class="col-md-12">Confirm Password</label>
                                    <div class="col-md-12">
                                        <input type="password" placeholder="Confirm password"   name="cpassword" class="form-control form-control-line"> </div>
                                      
                                </div>

                             
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-success" name="save" value="Save"> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>




                

            </div>
            <!-- /.container-fluid -->
               <script type="text/javascript">
        
      document.getElementById('role').value='<?php echo $Data['Role'];?>';

    </script>
                   <?php include 'shared/footer.php';?>