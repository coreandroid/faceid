
<?php

include 'conn.php';
if(!isset($_SESSION['LogId'])){

  header('location:login.php');

}


if(isset($_GET['section'])){

$ssql  = mysqli_query($conn,"select * from sections where Id='$_GET[section]'");


$sdata =  mysqli_fetch_array($ssql,MYSQLI_ASSOC);
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
                        <h2 class="page-title">Attendance <?php if(isset($sdata)) {echo $sdata['Name'];}?></h2>


                        <br> 



                    </div>
                    
                    <!-- /.col-lg-12 -->
                </div>
             <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            
                            <div class="table-responsive">

                          <form class="form-inline no-print"  >
  <div class="form-group no-print">
    <input type="txt" name="q" class="form-control" placeholder="Search...">
     <select class="form-control"  name="type">
     
      <option>Present</option>
      <option>Absent</option>
     </select>
    <select class="form-control no-print"  name="section">
       
    <?php 
                                            
                                            

                                              $sql = "select * from sections where Name like '%$q%' and TeacherId ='$_SESSION[LogId]'";
                                              $result = mysqli_query($conn,$sql);

                                               while($data=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                               {


                                             ?>
                                          <option value="<?= $data['Id'];?>"><?= $data['Name'];?></option>
                                            <?php }?>

</select>
   
  </div>
  <div class="form-group no-print">
  
    <input type="date" name="date" class="form-control" id="idate" value="<?php if(isset($_GET['date'])){echo $_GET['date'];}?>" >
  </div>
  
  <button type="submit" class="btn btn-default no-print">Submit</button>
</form>
     <br>

                                                <td><?php echo $data['Gender'];?></td>
 <button class="btn btn-info no-print" onclick="window.print()">Print</button>
                                                <td><?php echo $data['Gender'];?></td>
       <a href="export.php?php?q=&type=<?php if(isset($_GET['type'])){echo $_GET['type'];}?>&section=<?php if(isset($_GET['section'])){echo $_GET['section'];}?>&date=<?php if(isset($_GET['date'])){echo $_GET['date'];}?>" class="btn btn-success no-print">Export</a>

                                <?php  if(isset($_GET['section'])) { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                              <th>Date</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Status</th>
                                        
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            
                                              $q='';
                                              if(isset($_GET['q'])) $q = $_GET['q'];

                                              if($_GET['type'] == 'Present')
                                              {

                                                 

                                                $sql = "select student.*,att.Id as tid from attendances att left join students student on att.StudentId = student.Id  where att.SectionId = '$_GET[section]' and att.PDate = '$_GET[date]' and (student.Fname like '%$q%' or student.Lname like '%$q%') order by student.Lname asc";
                                             
                                              }
                                              else if($_GET['type'] == 'Absent'){

 
                                                $sql = "select * from (select student.*,att.Id as tid from attendances att left join students student on att.StudentId <> student.Id  where att.SectionId = '$_GET[section]' and att.PDate = '$_GET[date]' and (student.Fname like '%$q%' or student.Lname like '%$q%') order by student.Lname asc) m where m.SectionId='$_GET[section]'";
                                               
                                              
                                            

                                              }
                                            else{

                                                 $sql = "select student.*,att.Id as tid from attendances att left join students student on att.StudentId <> student.Id  where att.SectionId in (select Id from sections where  TeacherId ='$_SESSION[LogId]') and att.PDate = '$_GET[date]' and (student.Fname like '%$q%' or student.Lname like '%$q%') order by student.Lname asc";

                                                }


                                              $result = mysqli_query($conn,$sql);

                                               while($data=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                               {


                                             ?>
                                            <tr>
                                             
                                              <td><?php echo $data['SId'];?></td>
                                                 <td><?php echo $_GET['date'];?></td>
                                                <td><?php echo ucfirst($data['Lname']);?> <?php echo ucfirst($data['Fname']);?></td>
                                                <td><?php echo $data['Gender'];?></td>
                                                <td><?php echo $_GET['type'];?></td>
                                             
                                        
                                               
                                                <td class="text-primary no-print"><a href="deleteattendance.php?Id=<?php echo $data['tid'];?>" class="btn btn-danger btn-sm no-print">Delete</a></td>
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
