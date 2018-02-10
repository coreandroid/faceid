<?php
session_start();
date_default_timezone_set('Asia/Manila');


function Request($queryUrl,$imageObject){


   $request = curl_init($queryUrl);

// set curl options
curl_setopt($request, CURLOPT_POST, true);
curl_setopt($request,CURLOPT_POSTFIELDS, $imageObject);
curl_setopt($request, CURLOPT_HTTPHEADER, array(
        "Content-type: application/json",
        "app_id:bd432bdd",
        "app_key:bf9638a09c6c80a3940b782de3c5f5dc"
    )
);

curl_setopt($request, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($request);

return $response;


}


$conn = mysqli_connect("localhost","root","","face");
//$conn = mysqli_connect("localhost","id1184091_faceid","myroot","id1184091_face");



?>