
<?php

include 'conn.php';
if(!isset($_SESSION['LogId'])){

  header('location:login.php');

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
                        <h2 class="page-title">Attendance</h2>


                        <br> 



                    </div>
                    
                    <!-- /.col-lg-12 -->
                </div>
             <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            
                            <div class="table-responsive">

                          <form class="form-inline"  >
  <div class="form-group">
    <input type="txt" name="q" class="form-control" placeholder="Search...">
    <select class="form-control"  name="section">
  
    <?php 
                                            
                                            

                                              $sql = "select * from sections where Name like '%$q%'";
                                              $result = mysqli_query($conn,$sql);

                                               while($data=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                               {


                                             ?>
                                          <option value="<?= $data['Id'];?>"><?= $data['Name'];?></option>
                                            <?php }?>

</select>
   
  </div>
  <div class="form-group">
  
    <input type="date" name="date" class="form-control" id="idate" value="<?= $_GET['date'];?>" >
  </div>
  
  <button type="submit" class="btn btn-default">Submit</button>
</form>
     

                                <?php  if(isset($_GET['section'])) { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            
                                              $q='';
                                              if(isset($_GET['q'])) $q = $_GET['q'];

                                              $sql = "select student.*,att.Id as tid from attendances att join students student on att.StudentId = student.Id  where att.SectionId = '$_GET[section]' and att.PDate = '$_GET[date]' and (student.Fname like '%$q%' or student.Lname like '%$q%')";


                                         
                                              $result = mysqli_query($conn,$sql);

                                               while($data=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                               {


                                             ?>
                                            <tr>
                                             
                                              <td><?php echo $data['Id'];?></td>
                                                <td><?php echo $data['Lname'];?> <?php echo $data['Fname'];?></td>
                                                <td><?php echo $data['Gender'];?></td>
                                        
                                               
                                                <td class="text-primary"><a href="deleteattendance.php?Id=<?php echo $data['tid'];?>" class="btn btn-danger btn-sm">Delete</a></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                       
                                    </tbody>
                                </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>




                 

            </div>
            <!-- /.container-fluid -->
<?php if((!isset($_GET['date']))||strlen($_GET['date']) == ''){ ?>
            <script type="text/javascript">
              

var now = new Date();

var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);

var today = now.getFullYear()+"-"+(month)+"-"+(day) ;


              document.getElementById("idate").value = today;
            </script>
            <?php } ?>
                   <?php include 'shared/footer.php';?>