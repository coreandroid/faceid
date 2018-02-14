<?php 

include 'conn.php';

$target_path = "upload/";

$target_path = $target_path . 'face.jpg'; 

if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
   


      $base64 = base64_encode(file_get_contents("upload/face.jpg"));
      $queryUrl = "https://api.kairos.com/recognize";
      $imageObject = '{"image":"data:image/jpeg;base64,'.$base64.'","gallery_name":"Students"}';
    
  

   echo Request($queryUrl,$imageObject);




} else{
    echo "There was an error uploading the file, please try again!";
}
?>