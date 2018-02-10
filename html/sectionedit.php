<?php
   include 'conn.php';
   if(!isset($_SESSION['LogId'])){

  header('location:login.php');

}
   $Data=[]; 
  
   $result = mysqli_query($conn,"select * from sections where Id=$_GET[Id]");

  $Data=mysqli_fetch_array($result,MYSQLI_ASSOC);

   if(intval($_GET['Id']) > 0 == false){

     $Data['Name'] = "";
     $Data['Id'] = "0";
     $Data['Description'] = "";
     $Data['StartDate'] = date("Y-m-d");

   }

   if(isset($_POST['save'])){

     if(intval($_POST['Id']) > 0){ // if hash id then update
 
     $stmt = $conn->prepare("UPDATE sections set Name=?,Description=? where Id=?");
     $stmt->bind_param("ssi", $name, $description,$_POST['Id']);

 
     $name = $_POST['name'];
     $description = $_POST['description'];
    
    

     $stmt->execute();

     $stmt->close();
     $conn->close();
 echo "<script>alert('Section is Updated');window.location.assign('section.php');</script>";
     }else { //if not then add

     $stmt = $conn->prepare("INSERT INTO sections ( `TeacherId`, `Name`, `Description`) VALUES (?, ?, ?)");
     $stmt->bind_param("sss", $userid,$name, $description);

     $userid =  $_SESSION['LogId'];
     $name = $_POST['name'];
     $description = $_POST['description'];
 
    
     $stmt->execute();
  
   
     $stmt->close();

    echo "<script>alert('Section is Added');window.location.assign('section.php');</script>";

  
     }

   }



   if(isset($_POST['addstudent'])){
   

   

   if(intval($Data['Id']) > 0){


    
  

     $stmt = $conn->prepare("INSERT INTO students ( `Fname`, `Lname`, `Gender`, `SectionId`,`Image`) VALUES (?, ?, ?,?,?)");
     $stmt->bind_param("sssss", $_POST['fname'],$_POST['lname'],$_POST['gender'], $Data['Id'],$image);
     
      if (move_uploaded_file($_FILES["image"]["tmp_name"],'images/'.$_FILES["image"]["name"])) {
            $image = $_FILES["image"]["name"];

         

     
   

   $queryUrl = "http://api.kairos.com/enroll";
$imageObject = '{
    "image":"https://ediobot.000webhostapp.com/faceid/html/images/'.$image.'","subject_id":"'.$_POST['lname'].' '.$_POST['fname'].'","gallery_name":"Students"}';

 


   $r = json_decode(Request($queryUrl,$imageObject),true);
  
     if(!isset($r['Errors'])){
           $stmt->execute();
           echo "<script>alert('Student added');</script>";

          $stmt->close();
      }else{

              echo "<script>alert('".$r['Errors'][0]['Message']."');</script>";

      }

   }
 
        
    } else{


     echo "<script>alert('Create a section first');</script>";

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
                                    <label class="col-md-12">Description</label>
                                    <div class="col-md-12">
                                        <textarea type="text" placeholder="Description" name="description" class="form-control form-control-line"><?= $Data['Description'];?></textarea>
                                         </div>
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




                  <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title">Students</h3> 
                       <form class="form-inline" method="post" enctype="multipart/form-data">
  <div class="form-group">
    
    <input type="text" class="form-control" id="email" required name="fname" placeholder="First name">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="email" required name="lname" placeholder="Last name">
  </div>
    <div class="form-group">
   <select class="form-control" name="gender">
       
       <option>Male</option>
       <option>Female</option>

   </select>
  </div>
   <div class="form-group">
    <input type="file" class="form-control" name="image" id="email" required placeholder="Lname">
  </div>
 
 
  <input type="submit" class="btn btn-default" name="addstudent" value="Add">
</form>





<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Gender</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                                               
                                              $q='';
                                              if(isset($_GET['q'])) $q = $_GET['q'];


                                              $sql = "select * from students where SectionId = '$Data[Id]' order by Lname asc";
                                              $result = mysqli_query($conn,$sql);

                                               while($data=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                               {


                                             ?>
                                            <tr>
                                                <td><?= $data['Id'];?></td>
                                                <td><img src="images/<?= $data['Image']; ?>" style="width: 70px; height: 70px;"></td>
                                                <td><?= $data['Lname'].', '.$data['Fname'];?></td>
                                                <td><?= $data['Gender'];?></td>
                                                
                                                <td><a href="studentdelete.php?Id=<?= $data['Id'];?>" class="btn btn-danger">Delete</a></td>
                                            </tr>
                                            <?php }  ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
                   <?php include 'shared/footer.php';?>