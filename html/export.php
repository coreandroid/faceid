<?php
include 'conn.php';
if(!isset($_SESSION['LogId'])){

  header('location:login.php');

}

$filename ="report.xls"; 
  header("Content-Type: application/vnd.ms-excel");
 header("Content-Disposition: attachment; filename=\"$filename\"");





?>

 <?php  if(isset($_GET['section'])) { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Last name</th>
                                            <th>First name</th>
                                            <th>Gender</th>
                                            <td>Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            
                                              $q='';
                                              if(isset($_GET['q'])) $q = $_GET['q'];

                                              if($_GET['type'] == 'Present')
                                              {

                                                $sql = "select student.*,att.Id as tid,'Present' as Status from attendances att left join students student on att.StudentId = student.Id  where att.SectionId = '$_GET[section]' and att.PDate = '$_GET[date]' and (student.Fname like '%$q%' or student.Lname like '%$q%') order by student.Lname asc";

                                              }
                                              else{

                                                $sql = "select student.*,att.Id as tid,'Absent' as Status from attendances att left join students student on att.StudentId <> student.Id  where att.SectionId = '$_GET[section]' and att.PDate = '$_GET[date]' and (student.Fname like '%$q%' or student.Lname like '%$q%') order by student.Lname asc";

                                              }
                                         
                                              $result = mysqli_query($conn,$sql);

                                               while($data=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                               {


                                             ?>
                                            <tr>
                                             
                                              <td><?php echo $data['SId'];?></td>
                                                <td><?php echo ucfirst($data['Lname']);?></td>
                                                <td><?php echo ucfirst($data['Fname']);?></td>
                                                <td><?php echo $data['Gender'];?></td>
                                        
                                               
                                                <td class="text-primary"><?php echo $data['Status'];?></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                       
                                    </tbody>
                                </table>
                                <?php } ?>