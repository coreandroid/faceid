<?php

include 'conn.php';


if(!isset($_SESSION['LogId'])){

  header('location:login.php');

}
mysqli_query($conn,"delete from users where Id=$_GET[Id]");

 if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
?>