<?php
session_start();
include "../php/connect.php";
if($_SESSION['status'] != "2")
{
   echo "This page for User only!";
   exit();
}
$sql = "SELECT * FROM tbl_user WHERE userid = '{$_SESSION["userid"]}'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query);

$sqlhydro = "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND deviceID = '1' ";
$queryhydro = mysqli_query($conn, $sqlhydro);
$resulthydro  = mysqli_query($conn, $sqlhydro);
$numhydro = mysqli_num_rows($resulthydro);


$sqlsoil = "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND deviceID = '2' ";
$querysoil  = mysqli_query($conn, $sqlsoil );
$resultsoil   = mysqli_query($conn, $sqlsoil );
$numsoil  = mysqli_num_rows($resultsoil );

$sqlaqua = "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND deviceID = '3' ";
$queryaqua = mysqli_query($conn, $sqlaqua);
$resultaqua  = mysqli_query($conn, $sqlaqua);
$numaqua = mysqli_num_rows($resultaqua);

$sqlauto = "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND mode = 'auto' ";
$queryauto  = mysqli_query($conn, $sqlauto );
$resultauto  = mysqli_query($conn, $sqlauto );
$numauto  = mysqli_num_rows($resultauto );


$sqlmanual= "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND mode = 'manual' ";
$querymanual  = mysqli_query($conn, $sqlmanual );
$resultmanual  = mysqli_query($conn, $sqlmanual );
$nummanual  = mysqli_num_rows($resultmanual );


$sqlsettime = "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND mode = 'settime' ";
$querysettime  = mysqli_query($conn, $sqlsettime );
$resultsettime  = mysqli_query($conn, $sqlsettime );
$numsettime  = mysqli_num_rows($resultsettime );


$sqlsetmois = "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND mode = 'setmois' ";
$querysetmois  = mysqli_query($conn, $sqlsetmois );
$resultsetmois  = mysqli_query($conn, $sqlsetmois );
$numsetmois  = mysqli_num_rows($resultsetmois );

$sqlnovalue = "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND mode = '' ";
$querynovalue  = mysqli_query($conn, $sqlnovalue );
$resultnovalue = mysqli_query($conn, $sqlnovalue );
$numnovalue  = mysqli_num_rows($resultnovalue ); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hydro Control</title>

    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Poiret+One" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/justgage/1.2.9/justgage.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body body style="background-color: #93cc01; font-family: 'Vollkorn', serif;">

                <div class="container">
                    <div class="row">
                      <div class="col-md-4 col-md-offset-4">
                        <div class="col-lg-12" style="text-align: center;">
                          <img src="../img/biologisch-icoon.png" width="150px" height="150px">


                  <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #00BF9A;">

                    <h4><i class="fa fa-pagelines fa-fw" style="color:white"></i> <font color="#FAFAFA">Set Mode</font></h4>
                    </div>

                      <div class="panel-body" >

                  <div class="row" style='display: flex; justify-content: center;flex-wrap: wrap;'>

                    <div class="col-xs-12 col-lg-12">
                       <?php

                      if($numauto > 0 || $numnovalue > 0){
                    echo'<div class="row">
                    <div class="col-xs-12 col-lg-12">
                    <form action="../php/page_updatemode.php" method="post">
                    <button  name="mode" value="auto" onclick="auto();" type="submit" class="btn btn-success" style="padding: 10px 30px;"><font color="white">Auto</font>
                    <input  type="hidden" name="txtuserid" value="'; echo $result["userid"]; echo '">
                      </form>
                    </div>
                  </div>
                <br>';}

                       if($nummanual > 0 || $numnovalue > 0){
                         echo'<div class="row">
                         <div class="col-xs-12 col-lg-12">
                         <form action="../php/page_updatemode.php" method="post">
                         <button  name="mode" onclick="manual();" value="manual" type="submit" class="btn btn-success" style="padding: 10px 22px;"><font color="white">Manual</font>
                         <input  type="hidden" name="txtuserid" value="'; echo $result["userid"]; echo '">
                           </form>
                         </div>
                       </div><br>';}

                        if($numsettime > 0 || $numnovalue > 0){
                          echo'<div class="row">
                          <div class="col-xs-12 col-lg-12">
                          <form action="../php/page_updatemode.php" method="post">
                          <button  name="mode" value="settime" onclick="settime();" type="submit" class="btn btn-success" style="padding: 10px 16px;"><font color="white">Set-Time</font>
                          <input  type="hidden" name="txtuserid" value="'; echo $result["userid"]; echo '">
                            </form>
                          </div>
                        </div>

                    <br>';

                  }
                       ?>

                         <?php if($numsoil > 0){
                             if($numsetmois > 0 || $numnovalue > 0){
                         ?>
                              <div class="row">
                              <div class="col-xs-12 col-lg-12">
                              <form action="../php/page_updatemode.php" method="post">
                              <button  name="mode" value="setmois" onclick="setmoisture();" type="submit" class="btn btn-success" style="padding: 10px 5px;"><font color="white">Set-Moisture</font></button>
                              <input  type="hidden" name="txtuserid" value="<?php echo $result["userid"];?>">
                                </form>
                              </div>
                            </div><br>
                            <?php
                           }
                   }?>

<a href="../php/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

<script>

var config = {
  apiKey: "<?php echo $result["apiKey"]; ?>",
  authDomain: "<?php echo $result["authDomain"]; ?>",
  databaseURL: "<?php echo $result["databaseURL"]; ?>",
  projectId: "<?php echo $result["projectId"]; ?>",
  storageBucket: "<?php echo $result["storageBucket"]; ?>",
  messagingSenderId: "<?php echo $result["messagingSenderId"]; ?>"
};

firebase.initializeApp(config);

function auto() {
         return firebase.database().ref('/grow/<?php echo $result["userid"]; ?>/switchselect').set("auto");
         //return firebase.database().ref('/grow/<?php echo $result["userid"]; ?>/switchselect').update("auto");
}
function manual() {
         return firebase.database().ref('/grow/<?php echo $result["userid"]; ?>/switchselect').set("manual");
         //return firebase.database().ref('/grow/<?php echo $result["userid"]; ?>/switchselect').update("manual");
}
function settime() {
         return firebase.database().ref('/grow/<?php echo $result["userid"]; ?>/switchselect').set("time");
         //return firebase.database().ref('/grow/<?php echo $result["userid"]; ?>/switchselect').update("time");
}
function setmoisture() {
         return firebase.database().ref('/grow/<?php echo $result["userid"]; ?>/switchselect').set("moisture");
         //return firebase.database().ref('/grow/<?php echo $result["userid"]; ?>/switchselect').update("moisture");
}

</script>
