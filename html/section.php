
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
                        <h2 class="page-title">Section</h2>


                        <br> 



                    </div>
                    
                    <!-- /.col-lg-12 -->
                </div>
             <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                           <a class="btn btn-success" href="sectionedit.php?Id=0">Create new section</a>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Number of student</th>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            
                                              $q='';
                                              if(isset($_GET['q'])) $q = $_GET['q'];

                                              $sql = "select * from sections where (Name like '%$q%' or Description like '%$q%') and TeacherId ='$_SESSION[LogId]'";
                                              $result = mysqli_query($conn,$sql);

                                               while($data=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                               {


                                             ?>
                                            <tr>
                                             
                                              <td><?php echo $data['Id'];?></td>
                                                <td><?php echo $data['Name'];?></td>
                                                <td><?php echo $data['Description'];?></td>
                                                <td><?php 
                                            
                                                      $squery = mysqli_query($conn,"select * from students where SectionId = '$data[Id]'");

                                                      echo mysqli_num_rows($squery);
 

                                                ?></td>
                                        
                                               
                                                <td class="text-primary"><a href="sectionedit.php?Id=<?php echo $data['Id'];?>" class="btn btn-info btn-sm">Edit</a> <a href="deletesection.php?Id=<?php echo $data['Id'];?>" class="btn btn-danger btn-sm">Delete</a></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>




                 

            </div>
            <!-- /.container-fluid -->
                   <?php include 'shared/footer.php';?>