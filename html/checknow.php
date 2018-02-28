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
                        <h2 class="page-title">Check Attendance</h2>


                        <br> 

                    

                    </div>
                    
                    <!-- /.col-lg-12 -->
                </div>

           

              <div class="row">
                  
                 
<center>

<select class="form-control" style="width: 300px;" id="section">
  
    <?php 
                                            
                                              $q='';
                                              if(isset($_GET['q'])) $q = $_GET['q'];

                                              $sql = "select * from sections where Name like '%$q%' or Description like '%$q%' and TeacherId ='$_SESSION[LogId]'";
                                              $result = mysqli_query($conn,$sql);

                                               while($data=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                               {


                                             ?>
                                          <option value="<?= $data['Id'];?>"><?= $data['Name'];?></option>
                                            <?php }?>

</select>



  <h1 id="demo"></h1></center>
<center>    <video id="video" width="540" height="380" autoplay></video><br>
  
    <canvas id="canvas" width="540" height="380" style="display: none;"></canvas></center>
<center>
    <center>  <button id="snap" class="btn btn-success">Patch</button></center>

              </div>



                 

            </div>
<div class="dimmer">
    

<div class="spinner">
  <div class="cube1"></div>
  <div class="cube2"></div>
</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

            <script type="text/javascript">
                

            setInterval(function(){

                 document.getElementById("demo").innerHTML = new Date().toString().replace("GMT+0800 (Malay Peninsula Standard Time)","");

            },1000);
           // Put event listeners into place
        window.addEventListener("DOMContentLoaded", function() {
            // Grab elements, create settings, etc.
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var video = document.getElementById('video');
            var mediaConfig =  { video: true };
            var errBack = function(e) {
                console.log('An error has occurred!', e)
            };

            // Put video listeners into place
            if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia(mediaConfig).then(function(stream) {
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                });
            }

            /* Legacy code below! */
            else if(navigator.getUserMedia) { // Standard
                navigator.getUserMedia(mediaConfig, function(stream) {
                    video.src = stream;
                    video.play();
                }, errBack);
            } else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
                navigator.webkitGetUserMedia(mediaConfig, function(stream){
                    video.src = window.webkitURL.createObjectURL(stream);
                    video.play();
                }, errBack);
            } else if(navigator.mozGetUserMedia) { // Mozilla-prefixed
                navigator.mozGetUserMedia(mediaConfig, function(stream){
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                }, errBack);
            }


            // Trigger photo take
            document.getElementById('snap').addEventListener('click', function() {
                $(".dimmer").css({display:'block'});
                context.drawImage(video, 0, 0, 640, 480);
             
             
               var blobBin = atob(canvas.toDataURL().split(',')[1]);
              var array = [];
              for(var i = 0; i < blobBin.length; i++) {
                 array.push(blobBin.charCodeAt(i));
               }
            var file=new Blob([new Uint8Array(array)], {type: 'image/png'});


           var formdata = new FormData();
         formdata.append("file", file);
         

       $.ajax({
          url: "upload.php",
          type: "POST",
          data: formdata,
          processData: false,
          contentType: false,
       }).done(function(respond){
                 
                

                 $(".dimmer").css({display:'none'});

                respond = JSON.parse(respond);

                if(respond.Errors == null){
               
               if(respond.images[0].transaction.subject_id){
                   alert("Thank you " + respond.images[0].transaction.subject_id)
                   $.get('present.php?Section='+$('#section').val()+'&Name='+respond.images[0].transaction.subject_id,function(){


                   });
               }else{

                 alert("Please focus your face");

               }
                }else{

                 alert(respond.Errors[0].Message)

                }

     });

            });

            
    }, false);


             </script>
            <!-- /.container-fluid -->
                   <?php include 'shared/footer.php';?>