<?php
include 'conn.php';


if(isset($_POST['login'])){


   $Username = mysqli_escape_string($conn,$_POST['uname']);
   $Password = mysqli_escape_string($conn,$_POST['pass']);

   $query = mysqli_query($conn,"SELECT * FROM users where Username='$Username' and Password='$Password'");

   if(mysqli_num_rows($query) > 0){

       $Data=mysqli_fetch_array($query,MYSQLI_ASSOC);
       $_SESSION['LogId'] = $Data['Id'];
       $_SESSION['LogRole'] = $Data['Role'];
       $_SESSION['LogName'] = $Data['Name'];
       header('location:section.php');

   }else{

    echo "<script>alert('Login Failed')</script>";

   }
  

}

?>


<?php include 'shared/header.php';?>
<body>
   
                      
<div class="container centered " style="
    max-width: 458px;
">
  <br>
  <br>
  <br>


  <center><h2>Welcome to Attendance System</h2></center>
  <br>
  
  <form method="post">
    <div class="form-group row">
      <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputEmail3" placeholder="Username" name="uname">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="inputPassword3" name="pass" placeholder="Password">
      </div>
    </div>
  
   
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <input type="submit" class="btn btn-primary" name="login" value="Sign in">
      </div>
    </div>
  </form>
</div>

   
 </body>
 </html>

