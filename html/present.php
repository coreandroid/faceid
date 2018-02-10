<?php

  include 'conn.php';

  $sectionId = $_GET['Section'];
  $studenName = explode(" ",$_GET['Name']);
  $Date = date("Y-m-d");

  $qstudent = mysqli_query($conn,"select * from students where Fname ='$studenName[1]' and Lname ='$studenName[0]'");
  $student = $data=mysqli_fetch_array($qstudent,MYSQLI_ASSOC);


   mysqli_query($conn,"insert into attendances(SectionId,studentId,PDate)values('$sectionId','$student[Id]','$Date')");


?>