<?php 

include 'conn.php';

$target_path = "upload/";

$target_path = $target_path . 'face.jpg'; 

if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
   

      $queryUrl = "https://api.kairos.com/recognize";
      $imageObject = '{"image":"https://ediobot.000webhostapp.com/faceid/html/upload/face.jpg","gallery_name":"Students"}';

 


   echo Request($queryUrl,$imageObject);




} else{
    echo "There was an error uploading the file, please try again!";
}
?>