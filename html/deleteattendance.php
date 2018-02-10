<?php

include 'conn.php';


 
mysqli_query($conn,"delete from attendances where Id=$_GET[Id]");

 if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
?>