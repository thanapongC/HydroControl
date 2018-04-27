<?php
session_start();
include "../php/connect.php";
if($_SESSION['status'] != "2")
{
   echo "This page for User only!";

   exit();
}

$sql = "SELECT * FROM tbl_user WHERE userid = '{$_SESSION["userid"]}'";
$sql2 = "SELECT * FROM tbl_user WHERE userid = '{$_SESSION["userid"]}'";
$sqlo = "SELECT * FROM tbl_numlamp WHERE NOT EXISTS
          (SELECT * FROM tbl_lamp WHERE userid ='" . $_SESSION["userid"] . "' AND tbl_lamp.keyid = tbl_numlamp.id )";
$sqlo2 = "SELECT * FROM tbl_realtimesensor WHERE NOT EXISTS
          (SELECT * FROM tbl_realtime WHERE userid ='" . $_SESSION["userid"] . "' AND tbl_realtime.keyid = tbl_realtimesensor.id )";

$query = mysqli_query($conn, $sql);
$query1 = mysqli_query($conn, $sqlo);
$result = mysqli_fetch_array($query);
$query2 = mysqli_query($conn, $sql2);
$query2 = mysqli_query($conn, $sqlo2);
$query3 = mysqli_query($conn, $sqlo2);
$querydevice = mysqli_query($conn, $sqlo);
$result2 = mysqli_fetch_array($query2);
$name = $_SESSION["name"];

$sqlhydro = "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND deviceID = '1' ";
$resulthydro  = mysqli_query($conn, $sqlhydro);
$numhydro = mysqli_num_rows($resulthydro);


$sqlsoil = "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND deviceID = '2' ";
$resultsoil   = mysqli_query($conn, $sqlsoil );
$numsoil  = mysqli_num_rows($resultsoil );


$sqlaqua = "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND deviceID = '3' ";
$resultaqua  = mysqli_query($conn, $sqlaqua);
$numaqua = mysqli_num_rows($resultaqua);


$sqlauto = "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND mode = 'auto' ";
$resultauto  = mysqli_query($conn, $sqlauto );
$numauto  = mysqli_num_rows($resultauto );


$sqlmanual= "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND mode = 'manual' ";
$resultmanual  = mysqli_query($conn, $sqlmanual );
$nummanual  = mysqli_num_rows($resultmanual );


$sqlsettime = "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND mode = 'settime' ";
$resultsettime  = mysqli_query($conn, $sqlsettime );
$numsettime  = mysqli_num_rows($resultsettime );


$sqlsetmois = "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND mode = 'setmois' ";
$resultsetmois  = mysqli_query($conn, $sqlsetmois );
$numsetmois  = mysqli_num_rows($resultsetmois );


$sqlnovalue = "SELECT * FROM tbl_user WHERE userid={$_SESSION["userid"]} AND mode = '' ";
$resultnovalue = mysqli_query($conn, $sqlnovalue );
$numnovalue  = mysqli_num_rows($resultnovalue );

$sqlstaton = "SELECT * FROM tbl_lamp WHERE userid={$_SESSION["userid"]} AND statdevice = 'on' ";
$resultstaton  = mysqli_query($conn, $sqlstaton  );
$numnstaton   = mysqli_num_rows($resultstaton  );

$sqlstatoff = "SELECT * FROM tbl_lamp WHERE userid={$_SESSION["userid"]} AND statdevice = 'off' ";
$resultstatoff = mysqli_query($conn, $sqlstatoff );
$numstatoff  = mysqli_num_rows($resultstatoff ); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hydro Control</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Poiret+One" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/justgage/1.2.9/justgage.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
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
</script>
<body>

    <div id="wrapper" style="background-color: #00BF9A; font-family: 'Vollkorn', serif;">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #00BF9A;" >
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" >
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="index.php"> <i class="fa fa-pagelines fa-fw" style="color:white"></i>  <font color="#FAFAFA">GROW PANEL</font></a>
            </div>

            <ul class="nav navbar-top-links navbar-right"  style="left:0">
                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw" style="color:white"></i>
                        <i class="fa fa-caret-down" style="color:white"></i>
                    </a>
                    <!-- data-toggle="modal" data-target="#watersensor" -->
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="" data-toggle="modal" data-target="#userprofile"><i class="fa fa-user fa-fw"></i> User Profile &nbsp; | &nbsp; <span><?php echo $_SESSION["name"]; ?></span> </a>
                        </li>
                        <li><a href="../php/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>

            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"></i> <font color="black"> Home</font></a>
                        </li>
                        <!-- <li>
                            <a href="data.php"></i> <font color="black"> Data</font></a>
                        </li> -->
                    </ul>
            </div>
        </nav>

        <div id="page-wrapper"><br>
            <div class="row">

            <?php
                $sqlrealtimeair = "SELECT * FROM tbl_realtime WHERE userid={$_SESSION["userid"]} AND devicetype = 'Air' ";
                $queryrealtimeair = mysqli_query($conn, $sqlrealtimeair);
                $resultair  = mysqli_query($conn, $sqlrealtimeair);
                $numair = mysqli_num_rows($resultair);
                $sqlrealtimewater = "SELECT * FROM tbl_realtime WHERE userid={$_SESSION["userid"]} AND devicetype = 'Water' ";
                $queryrealtimewater = mysqli_query($conn, $sqlrealtimewater);
                $resultwater  = mysqli_query($conn, $sqlrealtimewater);
                $numwater = mysqli_num_rows($resultwater);
            ?>


                <div class="col-lg-8">
                  <!-- Start water sensor -->
                              <div class="panel panel-default" >
                                <div class="panel-heading" style="background-color: #00BF9A;">
                                  <h4>
                                    <i class="fa fa-tint fa-fw" style="color:white"></i>
                                    <font color="#FAFAFA">Water Sensor</font>
                                  </h4>
                                <hr>
                                <div style="text-align: right;">
                                  <button type="button" class="btn btn-warning btn-circle" name="adddevice" data-toggle="modal" data-target="#watersensor"><i class="fa fa-plus-circle"></i>
                                </div>
                                </div>
                                <div class="row"  style='display: flex; justify-content: center;flex-wrap: wrap;'>
                                  <!-- PHP -->
                                  <?php
                                    $i = 0;while ($resultrealtimewater = mysqli_fetch_array($queryrealtimewater, MYSQLI_ASSOC))
                                   {?>

                                    <div class="col-lg-4 col-xs-10">
                                      <br>
                                       <div class="panel panel-default">
                                         <div class="panel-heading" style="background-color: #00BF9A;">
                                            <a href="../php/delete_confirm2.php?portid=<?php echo $resultrealtimewater["portid"]; ?>" onclick="return confirm('คุณต้องการลบข้อมูล ?');">
                                              <div style="text-align: right;">
                                                <button type="button" class="btn btn-warning btn-circle" ><i class="fa fa-minus-circle"></i>
                                              </div>
                                            </a>
                                              <center>
                                                <font color="#FAFAFA"> <?php echo $resultrealtimewater["devicename"]; ?></font>
                                              <center>
                                        </div>
                                          <br>
                                            <?php echo "<div id='gauge" . $resultrealtimewater["keyid"] . "' class='200x160px'></div>";?>
                                       </div>
                                    </div> &nbsp; &nbsp; &nbsp; &nbsp;
                                 <?php $i++; }?>
                                    <?php
                                      if($numwater == 0){
                                        echo " <h3>None</h3> ";
                                      } ?>
                              </div>
                           </div>
<!-- /end water sensor -->

                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: #00BF9A;">
                          <h4>
                            <i class="fa fa-soundcloud fa-fw" style="color:white"></i>
                              <font color="#FAFAFA">Air Sensor</font>
                          </h4>
                        </div>
                          <div class="row"  style='display: flex; justify-content: center;flex-wrap: wrap;'>
                            <!-- PHP -->
                            <?php
                              $i = 0;while ($resultrealtimeair = mysqli_fetch_array($queryrealtimeair, MYSQLI_ASSOC))
                            {?>

                              <div class="col-xs-10 col-lg-4"><br>
                                <div class="panel panel-default">
                                  <div class="panel-heading" style="background-color: #00BF9A;">
                                    <a href="../php/delete_confirm2.php?portid=<?php echo $resultrealtimeair["portid"]; ?>" onclick="return confirm('คุณต้องการลบข้อมูล ?');">
                                      <div style="text-align: right;">
                                        <button type="button" class="btn btn-warning btn-circle" ><i class="fa fa-minus-circle"></i>
                                      </div>
                                    </a>
                                     <center>
                                       <font color="#FAFAFA"><?php echo $resultrealtimeair["devicename"]; ?></font>
                                     </center>
                                  </div>
                                   <br>
                                     <?php echo "<div id='gauge" . $resultrealtimeair["keyid"] . "' class='200x160px'>";
                                       echo "</div>";?>
                                   <br>
                              </div>
                            </div> &nbsp; &nbsp; &nbsp; &nbsp;

                         <?php $i++;  }?>
                         <?php
                              if($numair == 0){
                                  echo "<h3>None</h3> ";
                              }  ?>
                      </div>
                    </div>
  <!-- /end air sensor -->


                     <div class="panel panel-default">
                       <div class="panel-heading" style="background-color: #00BF9A;">
                         <h4>
                           <i class="fa fa-power-off fa-fw" style="color:white"></i>
                             <font color="#FAFAFA">ON-OFF Devices Panel</font>
                        </h4>
                       <hr>
                         <div style="text-align: right;">
                           <button type="button" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#onoffdevice">
                             <i class="fa fa-plus-circle"></i>
                         </div>
                      </div>
                        <div class="panel-body">
                          <?php
                            if($numauto > 0 || $numsettime > 0 || $numsetmois > 0 || $numnovalue > 0){
                              echo'<fieldset disabled="">';
                            }?>
                          <div class="list-group">
                            <!-- PHP -->
                            <?php
                            $sql = "SELECT * FROM tbl_lamp WHERE userid='{$_SESSION["userid"]}'";
                            $query = mysqli_query($conn, $sql);
                            $i = 0;while ($resultonoff = mysqli_fetch_array($query, MYSQLI_ASSOC))
                         {?>

                          <div class="row">
                            <div class="col-lg-1 col-xs-2">
                              <a href="../php/delete_confirm.php?portid=<?php echo $resultonoff["portid"]; ?>" onclick="return confirm('คุณต้องการลบข้อมูล ?');"  style="color:#FFFFFF">
                                <button type="button" class="btn btn-warning btn-circle" ><i class="fa fa-minus-circle"></i>
                              </a>
                            </div>
                            <!-- PHP -->

                              <div class="col-lg-6 col-xs-4" style="font-family: 'Poiret One', cursive;font-size:18px">

                                <?php echo $resultonoff["lampname"]; ?>
                              </div>
                                <div class="col-lg-2 col-xs-3">
                                  <script>
                                  console.log("<?php echo $resultonoff["keyid"];?>")
                                  console.log("<?php echo $resultonoff["statdevice"];?>")
                                   if(("<?php echo $resultonoff["keyid"];?>" == '1') && ("<?php echo $resultonoff["statdevice"];?>" == "on")){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v1').set("on");
                                   }else if(("<?php echo $resultonoff["keyid"];?>" == '1') && ("<?php echo $resultonoff["statdevice"];?>" == "off")){
                                      firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v1').set("off");
                                    }
                                   if("<?php echo $resultonoff["keyid"];?>" == '2' && "<?php echo $resultonoff["statdevice"];?>" == "on"){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v2').set("on");
                                   }else if("<?php echo $resultonoff["keyid"];?>" == '2' && "<?php echo $resultonoff["statdevice"];?>" == "off"){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v2').set("off");
                                   }
                                   if("<?php echo $resultonoff["keyid"];?>" == '3' && "<?php echo $resultonoff["statdevice"];?>" == "on"){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v3').set("on");
                                   }else if("<?php echo $resultonoff["keyid"];?>" == '3' && "<?php echo $resultonoff["statdevice"];?>" == "off"){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v3').set("off");
                                   }
                                   if("<?php echo $resultonoff["keyid"];?>" == '4' && "<?php echo $resultonoff["statdevice"];?>" == "on"){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v4').set("on");
                                   }else if("<?php echo $resultonoff["keyid"];?>" == '4' && "<?php echo $resultonoff["statdevice"];?>" == "off"){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v4').set("off");
                                   }
                                   if("<?php echo $resultonoff["keyid"];?>" == '5' && "<?php echo $resultonoff["statdevice"];?>" == "on"){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay12v1').set("on");
                                   }else if("<?php echo $resultonoff["keyid"];?>" == '5' && "<?php echo $resultonoff["statdevice"];?>" == "off"){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay12v1').set("off");
                                   }
                                   if("<?php echo $resultonoff["keyid"];?>" == '6' && "<?php echo $resultonoff["statdevice"];?>" == "on"){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay12v2').set("on");
                                   }else if("<?php echo $resultonoff["keyid"];?>" == '6' && "<?php echo $resultonoff["statdevice"];?>" == "off"){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay12v2').set("off");
                                   }
                                   if("<?php echo $resultonoff["keyid"];?>" == '7' && "<?php echo $resultonoff["statdevice"];?>" == "on"){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay5v1').set("on");
                                   }else if("<?php echo $resultonoff["keyid"];?>" == '7' && "<?php echo $resultonoff["statdevice"];?>" == "off"){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay5v1').set("off");
                                   }
                                   if("<?php echo $resultonoff["keyid"];?>" == '8' && "<?php echo $resultonoff["statdevice"];?>" == "on"){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay5v2').set("on");
                                   }else if("<?php echo $resultonoff["keyid"];?>" == '8' && "<?php echo $resultonoff["statdevice"];?>" == "off"){
                                     firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay5v2').set("off");
                                   }
                                  </script>
                                  <?php
                                  if($resultonoff["statdevice"] == "on"){echo'<fieldset disabled="">';}?>

                                  <form action="../php/insertstatusdevice.php" method="post">
                                  <input type="hidden" name="txtuserid" size="20" required autofocus value="<?php echo $_SESSION["userid"]; ?>">
                                  <input type="hidden" name="txtkeyid" size="20" required autofocus value="<?php echo $resultonoff["keyid"]; ?>">
                                  <button id="led-on" onclick="on<?php echo $resultonoff["keyid"]; ?>();"type="submit" class="btn btn-success btn-circle btn-lg" id="timestart<?php echo $resultset["keyid"];?>"  name="timestart" value="on"><i class="fa fa-square"></i>
                                  </form>
                                </div>
                                  <div class="col-lg-2 col-xs-3">
                                    <?php
                                    if($resultonoff["statdevice"] == "off"){echo'<fieldset disabled="">';}?>
                                    <form action="../php/insertstatusdevice.php" method="post">
                                    <input type="hidden" name="txtuserid" size="20" required autofocus value="<?php echo $_SESSION["userid"]; ?>">
                                       <input type="hidden" name="txtkeyid" size="20" required autofocus value="<?php echo $resultonoff["keyid"]; ?>">
                                    <button id="led-off"  type="submit"  onclick="off<?php echo $resultonoff["keyid"]; ?>();" class="btn btn-danger btn-circle btn-lg" id="timestart<?php echo $resultset["keyid"];?>"  name="timestart" value="off"><i class="fa fa-power-off"></i>
                                    </form>
                                  </div>
                          </div>
                            <hr>

                             <?php $i++; }?>

                        </div>
                      </div>
                    </div>
                  </div>

                <div class="col-lg-4">
                  <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #00BF9A;">
                      <h4>
                        <i class="fa fa-pagelines fa-fw" style="color:white"></i>
                        <font color="#FAFAFA">Set Mode</font>
                      </h4>
                          <?php if($numauto > 0 || $nummanual > 0 || $numsettime > 0 || $numsetmois > 0){
                              echo'
                              <div style="text-align: right;">
                                <form action="../php/page_removemode.php" method="post">
                                  <button name="mode" value="" type="submit" style="background-color: #FFFFFF; color:#00BF9A;">RESET</button>
                                  <input type="hidden" name="txtuserid" value="';echo $result["userid"];echo '">
                                  </form>
                              </div>';
                          }?>
                  </div>
                    <div class="panel-body" >
                      <div class="row" style='display: flex; justify-content: center;flex-wrap: wrap;'>
                        <div class="col-xs-12 col-lg-12">
                          <hr>
                          <!-- PHP -->
                           <?php
                             if($numauto > 0){
                               echo'<div class="row">
                                     <div class="col-xs-12 col-lg-12">
                                       <center> <font color="black">Auto</font></center>
                                     </div>
                                   </div>
                                <hr>';}
                             if($nummanual > 0 ){
                               echo'<div class="row">
                                      <div class="col-xs-12 col-lg-12">
                                        <center> <font color="black">Manual</font> </center>
                                      </div>
                                    </div>
                                    <hr>';}
                             if($numsettime > 0 ){
                              echo'<div class="row">
                                     <div class="col-xs-12 col-lg-12">
                                        <center> <font color="black">Set-Time</font><center>
                                     </div>
                                   </div>
                                  <hr>';} ?>

                            <?php
                              if($numsetmois > 0 ){
                                echo'<div class="row">
                                      <div class="col-xs-12 col-lg-12">
                                        <center> <font color="black">SetMoisture</font><center><hr>
                                      </div>
                                    ';
                                echo'<div class="row">
                                      <div class="col-xs-1 col-lg-1">
                                      </div>
                                      <div class="col-xs-4 col-lg-4">
                                        <font color="black">Input Value</font>
                                      </div>
                                      <div class="col-xs-4 col-lg-4">
                                        <p id="setmoisture"></p>
                                          <input class="form-control" id="valuemoisture" name="valuemoisture" required>
                                      </div>
                                      <div class="col-xs-2 col-lg-2">
                                      <br>
                                        <button type="button" class="btn btn-info btn-circle btn-lg" id="setmoisture"  name="setmoisture"><i class="fa fa-send"></i>
                                        </button>
                                      </div>
                                      <div class="col-xs-1 col-lg-1">
                                      </div>
                                    </div>';
                                echo "</div><hr> ";}?>
                            <?php
                              if($numaqua > 0){
                                echo'<div class="row">
                                      <div class="col-xs-4 col-lg-4">
                                        <font color="black">Set-Feed</font>
                                      </div>
                                      <div class="col-lg-5 col-xs-5">
                                        <div class="form-group has-success">
                                          <p id="feedstart"></p>
                                            <input class="form-control"  type="time" id="timefeed" name="timefeed">
                                        </div>

                                      </div>
                                      <div class="col-lg-2 col-xs-2">
                                      <br>
                                        <button type="button" class="btn btn-info btn-circle btn-lg" id="fishfeed" name="fishfeed"><i class="fa fa-send"></i>
                                        </button>
                                      </div>
                                    </div>
                                    <hr>';}?>
                                  </div>
                                </div>
                              </div>
                            </div>
                  <!-- start soil sensor -->

                  <!-- PHP -->
                  <?php
                      $sqlrealtimesoil = "SELECT * FROM tbl_realtime WHERE userid={$_SESSION["userid"]} AND devicetype = 'Soil' ";
                      $queryrealtimesoil = mysqli_query($conn, $sqlrealtimesoil);
                      $resultsoil  = mysqli_query($conn, $sqlrealtimesoil);
                      $numsoil = mysqli_num_rows($resultsoil);
                  ?>
                  <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #00BF9A;">
                      <h4>
                        <i class="fa fa-pagelines fa-fw" style="color:white"></i>
                        <font color="#FAFAFA">Soil Sensor</font>
                      </h4>
                    </div>
                      <div class="row" style='display: flex; justify-content: center;flex-wrap: wrap;'>
                          <!-- PHP -->
                          <?php
                            $i = 0;while ($resultrealtimesoil = mysqli_fetch_array($queryrealtimesoil, MYSQLI_ASSOC))
                          {?>

                        <div class="col-xs-10 col-lg-10">
                          <br>
                           <div class="panel panel-default">
                             <div class="panel-heading" style="background-color: #00BF9A;">
                                <a href="../php/delete_confirm2.php?portid=<?php echo $resultrealtimesoil["portid"]; ?>" onclick="return confirm('คุณต้องการลบข้อมูล ?');">
                                  <div style="text-align: right;">
                                    <button type="button" class="btn btn-warning btn-circle" ><i class="fa fa-minus-circle"></i>
                                  </div>
                                </a>
                                    <center>
                                      <font color="#FAFAFA"><?php echo $resultrealtimesoil["devicename"]; ?>
                              </div>
                            <br>
                              <!-- PHP -->
                                   <?php
                                     echo "<div id='gauge" . $resultrealtimesoil["keyid"] . "' class='200x160px'>";
                                     echo "</div>";
                                   ?>
                          </div>
                        </div> &nbsp; &nbsp; &nbsp; &nbsp;
                        <!-- PHP -->
                          <?php $i++; }
                            if($numsoil == 0){
                              echo "<h3>None</h3> ";
                            }
                          ?>
                    </div>
                  </div>

              <!-- /end soil sensor -->

                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: #00BF9A;">
                          <h4>
                            <i class="fa fa-clock-o fa-fw" style="color:white">
                            </i> <font color="#FAFAFA">Devices Time Setting</font>
                          </h4>
                        </div>
                        <!-- PHP -->
                          <?php
                              $sqlset = "SELECT * FROM tbl_lamp WHERE userid='{$_SESSION["userid"]}'";
                              $queryset = mysqli_query($conn, $sqlset);
                            ?>
                        <div class="panel-body" >
                          <!-- PHP -->
                          <?php
                            if($numauto > 0 || $nummanual > 0 || $numsetmois > 0 || $numnovalue > 0){
                              echo'<fieldset disabled="">';
                            }
                              $i = 0;while ($resultset = mysqli_fetch_array($queryset, MYSQLI_ASSOC)) {
                          ?>
                        <div class="row">
                          <div class="col-lg-3 col-xs-3" style="color:black;font-family: 'Poiret One', cursive;font-size:20px">
                            <!-- PHP -->
                              <?php echo $resultset["lampname"]; ?>
                          </div>
                        <div class="col-lg-1 col-xs-1">
                          <div class="row">
                           <div class="col-lg-6 col-xs-6">
                             <?php if($result["mode"] == "settime"){
                            echo '<br>';
                          }
                            ?>
                             <img src="../img/timen.jpg">
                           </div>
                          </div>
                        <br>
                          <div class="row">
                            <div class="col-lg-6 col-xs-6">
                              <br>
                                <img src="../img/timef.jpg">
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-5 col-xs-5">
                          <div class="form-group has-success">
                            <p id="<?php echo $resultset["keyid"];?>" style="color:black;"></p>
                             <input class="form-control"  type="time" id="timeron<?php echo $resultset["keyid"];?>" name="timeron" required>
                          </div>
                          <div class="form-group has-error">
                            <p id="<?php echo $resultset["keyid"];?><?php echo $resultset["keyid"];?>" style="color:black;"></p>
                              <input class="form-control"  type="time" id="timeroff<?php echo $resultset["keyid"];?>" name="timeroff" required>
                               <br>
                          </div>
                        </div>
                        <div class="col-lg-2 col-xs-2">
                          <button type="button" class="btn btn-info btn-circle btn-lg" id="timestart<?php echo $resultset["keyid"];?>"  name="timestart"><i class="fa fa-send"></i>
                          </button>
                        </div>
                     </div>
                     <!-- PHP -->
                            <?php $i++; }?>
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


    <!-- Start Model -->
    <div class="modal fade" id="watersensor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
         <div class="modal-header" style="background-color:#00BF9A; text-align:center">
           <h4 class="modal-title" id="exampleModalLongTitle" style="color:#FFFFFF ;">Add Real-Time Device</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body" style="color:black">
         <form action="../php/insertrealtime-device.php" method="post">
            <div class="form-group">
              <label for="devicename"><font color="red">*</font>Device Name :</label><br>
                <input class="form-control"  type="text" name="devicename" size="10"  placeholder="Enter Device Name" style="border-color:#00BF9A">
              </div>
                 <div class="form-group">
                     <label for="deviceid"><font color="red">*</font>Select Device</label><br>
                     <font color="black">
           <select class="form-control"  type="text" name="deviceid" style="border-color:#00BF9A" required>
                     <?php while ($result3 = mysqli_fetch_array($query3)) { ?>
                        <option value="<?php echo $result3["id"]; ?>"><?php echo $result3["devicename"]; ?></option>

                      <?php } ?>
           </select>
           </font>
           </div>
           <div class="form-group">
           <label for="deviceid"><font color="red">*</font>Select Device Type</label><br>
       <select  class="form-control"  type="text" name="txtdevicetype" style="border-color:#00BF9A" required>
           <option value="Water">Water Sensor</option>
           <option value="Soil">Soil Sensor</option>
           <option value="Air">Air Sensor</option>
       </select>
                     </div>
       <input type="hidden" name="txtuserid" size="20" required autofocus value="<?php echo $_SESSION["userid"]; ?>">



         </div>
         <div class="modal-footer" style="background-color:#00BF9A">
           <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color:#00BF9A;background-color:#FFFFFF;border-color:#FFFFFF">Close</button>
           <button type="submit" class="btn btn-primary"  onclick="return confirm('คุณต้องการเพื่มอุปกรณ์ ?');" style="color:#00BF9A;background-color:#FFFFFF;border-color:#FFFFFF">Save changes</button>
         </div>
         </form>
       </div>
     </div>
   </div>

   <div class="modal fade" id="onoffdevice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#00BF9A; text-align:center">
          <h4 class="modal-title" id="exampleModalLongTitle">Add ON-OFF Device</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="color:#000000;">
          <form action="../php/insertdevice.php" method="post">
              <div class="form-group">
                <label for="devicename" ><font color="red">*</font>Device Name :</label>
                <input  class="form-control"  type="text" name="devicename" placeholder="Enter Device Name" style="border-color:#00BF9A;"required>
             </div>
            <div class="form-group">
                <label for="deviceid"><font color="red">*</font>Select Device :</label><br>
                <font color="black">
            <select type="text" name="deviceid"  class="form-control" style="border-color:#00BF9A;"required>

                <?php while ($resultdevice = mysqli_fetch_array($querydevice)) {
                  ?>
                   <option value="<?php echo $resultdevice["id"]; ?>"><?php echo $resultdevice["devicename"]; ?></option>
                 <?php
               }
               ?>
       </select>
      </font>
               <input type="hidden" name="txtuserid" size="20" required autofocus value="<?php echo $_SESSION["userid"]; ?>">
               <input type="hidden" name="statdevice" size="20" required autofocus value="off">
            </div>

        </div>
        <div class="modal-footer" style="background-color:#00BF9A;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color:#00BF9A;background-color:#FFFFFF;border-color:#FFFFFF">Close</button>

          <button type="submit" class="btn btn-primary"  onclick="return confirm('คุณต้องการเพื่มอุปกรณ์ ?');" style="color:#00BF9A;background-color:#FFFFFF;border-color:#FFFFFF">Save changes</button>
        </div>
        </form>
      </div>
    </div>
   </div>
      <div class="modal fade" id="userprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
           <div class="modal-header" style="background-color:#00BF9A;color:#FFFFF;text-align:center">
             <h4 class="modal-title" id="exampleModalLongTitle">Your Profile</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body" style="color:#000000;">
             <form action="../php/edituser.php" method="post">

              <div class="form-group">
                   <label for="devicename" >Username :</label>
                          <input type="text" name="username" value="<?php echo $result["username"];?>"  class="form-control" disabled>
               </div>
              <div class="form-group">
                  <label for="devicename" >Password :</label>
                         <input type="text" name="password" value="<?php echo $result["password"];?>"  class="form-control" >
             </div>
              <div class="form-group">
                  <label for="devicename" >Name :</label>
                         <input type="text" name="name" value="<?php echo $result["name"];?>"  class="form-control">
              </div>
              <input type="hidden" name="userid" value="<?php echo $result["userid"];?>" >
            <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

             <button type="submit" class="btn btn-primary"  onclick="return confirm('คุณต้องการบันทึกข้อมูล ?');">Save changes</button>
           </div>
           </form>
         </div>
       </div>
      </div>
</body>
</html>

    <script>

  //var database = firebase.database();
  var WaterTemp = firebase.database().ref("<?php echo $result["userid"]; ?>/value/WaterTemp");
  var PHvalue = firebase.database().ref("<?php echo $result["userid"]; ?>/value/PHvalue");
  var ECvalue = firebase.database().ref("<?php echo $result["userid"]; ?>/value/ECvalue");
  var WaterLevel = firebase.database().ref("<?php echo $result["userid"]; ?>/value/WaterAlarm");
  var AirTemp = firebase.database().ref("<?php echo $result["userid"]; ?>/value/AirTemp");
  var AirHumid = firebase.database().ref("<?php echo $result["userid"]; ?>/value/AirHumid");
  var SoilMois = firebase.database().ref("<?php echo $result["userid"]; ?>/value/Soilmois");
  var feedstart = firebase.database().ref("<?php echo $result["userid"]; ?>/device/feedstart");
  var feedend = firebase.database().ref("<?php echo $result["userid"]; ?>/device/feedend");
  var relay220v1start = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay220v1/starttime");
  var relay220v1end = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay220v1/endtime");
  var relay220v2start = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay220v2/starttime");
  var relay220v2end = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay220v2/endtime");
  var relay220v3start = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay220v3/starttime");
  var relay220v3end = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay220v3/endtime");
  var relay220v4start = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay220v4/starttime");
  var relay220v4end = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay220v4/endtime");
  var relay12v1start = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay12v1/starttime");
  var relay12v1end = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay12v1/endtime");
  var relay12v2start = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay12v2/starttime");
  var relay12v2end = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay12v2/endtime");
  var relay5v1start = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay5v1/starttime");
  var relay5v1end = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay5v1/endtime");
  var relay5v2start = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay5v2/starttime");
  var relay5v2end = firebase.database().ref("<?php echo $result["userid"]; ?>/device/relay5v2/endtime");
  var moisture = firebase.database().ref("<?php echo $result["userid"]; ?>/device/moisture");
  feedstart.on('value', function(snapshot) {
  if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = "Time : "+hour+":"+minute;
  document.getElementById("feedstart").innerHTML = timeset;
  }
  });
  if("<?php echo $result["mode"];?>" == "setmois"){
  moisture.on('value', function(snapshot) {
  if(snapshot.val() != null){
  var moisset = "Moisture Set : "+snapshot.val()+" %";
  document.getElementById("setmoisture").innerHTML = moisset;
}else{
  var moisset = "Not Set Moisture"
  document.getElementById("setmoisture").innerHTML = moisset;
}
  });
}
if("<?php echo $result["mode"];?>" == "settime"){
  relay220v1start.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;

  document.getElementById("1").innerHTML = "Start : "+timeset;

}else{
  document.getElementById("1").innerHTML = "Not Set Time !! ";
}
  });

  relay220v1end.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("11").innerHTML = "End : "+timeset;
}else{
  document.getElementById("11").innerHTML = "Not Set Time !! ";
}
  });
  relay220v2start.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("2").innerHTML = "Start : "+timeset;
}else{
  document.getElementById("2").innerHTML = "Not Set Time !! ";
}
  });
  relay220v2end.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("22").innerHTML = "End : "+timeset;
}else{
  document.getElementById("22").innerHTML = "Not Set Time !! ";
}
  });
  relay220v3start.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("3").innerHTML = "Start : "+timeset;
}else{
  document.getElementById("3").innerHTML = "Not Set Time !! ";
}
  });
  relay220v3end.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("33").innerHTML = "End : "+timeset;
}else{
  document.getElementById("33").innerHTML = "Not Set Time !! ";
}
  });
  relay220v4start.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("4").innerHTML = "Start : "+timeset;
}else{
  document.getElementById("4").innerHTML = "Not Set Time !! ";
}
  });
  relay220v4end.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("44").innerHTML = "End : "+timeset;
}else{
  document.getElementById("44").innerHTML = "Not Set Time !! ";
}
  });
  relay12v1start.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("5").innerHTML = "Start : "+timeset;
}else{
  document.getElementById("5").innerHTML = "Not Set Time !! ";
}
  });
  relay12v1end.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("55").innerHTML = "End : "+timeset;
}else{
  document.getElementById("55").innerHTML = "Not Set Time !! ";
}
  });
  relay12v2start.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("6").innerHTML = "Start : "+timeset;
}else{
  document.getElementById("6").innerHTML = "Not Set Time !! ";
}
  });
  relay12v2end.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("66").innerHTML = "End : "+timeset;
}else{
  document.getElementById("66").innerHTML = "Not Set Time !! ";
}
  });
  relay5v1start.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("7").innerHTML = "Start : "+timeset;
}else{
  document.getElementById("7").innerHTML = "Not Set Time !! ";
}
  });
  relay5v1end.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("77").innerHTML = "End : "+timeset;
}else{
  document.getElementById("77").innerHTML = "Not Set Time !! ";
}
  });
  relay5v2start.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("8").innerHTML = "Start : "+timeset;
}else{
  document.getElementById("8").innerHTML = "Not Set Time !! ";
}
  });
  relay5v2end.on('value', function(snapshot) {
    if(snapshot.val() != null){
  var hour = snapshot.val().substring(0,2);
  var minute = snapshot.val().substring(2,4);
  var timeset = hour+":"+minute;
  document.getElementById("88").innerHTML = "End : "+timeset;
}else{
  document.getElementById("88").innerHTML = "Not Set Time !! ";
}

  });
}

  if("<?php echo $result["mode"];?>" == "auto"){
     firebase.database().ref('/<?php echo $result["userid"]; ?>/switchselect').set("auto");
     //firebase.database().ref('/<?php echo $result["userid"]; ?>/switchselect').update("auto");
  }else if("<?php echo $result["mode"];?>" == "manual"){
     firebase.database().ref('/<?php echo $result["userid"]; ?>/switchselect').set("manual");
     //firebase.database().ref('/<?php echo $result["userid"]; ?>/switchselect').update("manual");
  }else if("<?php echo $result["mode"];?>" == "settime"){
     firebase.database().ref('/<?php echo $result["userid"]; ?>/switchselect').set("time");
     //firebase.database().ref('/<?php echo $result["userid"]; ?>/switchselect').update("time");
  }else if("<?php echo $result["mode"];?>" == "setmois"){
     firebase.database().ref('/<?php echo $result["userid"]; ?>/switchselect').set("moisture");
     //firebase.database().ref('/<?php echo $result["userid"]; ?>/switchselect').update("moisture");
  }else{
     firebase.database().ref('/<?php echo $result["userid"]; ?>/switchselect').set("");
     //firebase.database().ref('/<?php echo $result["userid"]; ?>/switchselect').update("");
  }




                  function off1() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v1').set("off");
                           //return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v1').update("off");
                  }
                  function on1() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v1').set("on");
                           //return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v1').update("on");
                  }
                    //Electric Fan On-Off
                  function off2() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v2').set("off");
                           //return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v2').update("off");
                  }
                  function on2() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v2').set("on");
                           //return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v2').update("on");
                  }
                    //Spingker On-Off
                  function off3() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v3').set("off");
                           //return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v3').update("off");
                  }
                  function on3() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v3').set("on");
                           //return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v3').update("on");
                  }
                  //Heater On-Off
                  function off4() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v4').set("off");
                           //return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v4').update("off");
                  }
                  function on4() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v4').set("on");
                          // return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay220v4').update("on");
                  }
                  //Cooler On-Off
                  function off5() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay12v1').set("off");
                           //return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay12v1').update("off");
                  }
                  function on5() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay12v1').set("on");
                           //return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay12v1').update("on");
                  }

                  function off6() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay12v2').set("off");
                           //return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay12v2').update("off");
                  }
                  function on6() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay12v2').set("on");
                          // return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay12v2').update("on");
                  }
                  function off7() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay5v1').set("off");
                          // return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay5v1').update("off");
                  }
                  function on7() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay5v1').set("on");
                           //return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay5v1').update("on");
                  }
                  function off8() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay5v2').set("off");
                           //return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay5v2').update("off");
                  }
                  function on8() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay5v2').set("on");
                           //return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/relay5v2').update("on");
                  }

     /*-------    JQuery    --------*/

         $(document).ready(function(e) {

                  $("#timestart1").click(function(e) {
                       var timeron = $("#timeron1").val();
                       var hour = timeron.substring(0,2);
                       var minute = timeron.substring(3,5);
                       var timeset = hour+minute+"00";
                       var timeron1 = $("#timeroff1").val();
                       var hour1 = timeron1.substring(0,2);
                       var minute1 = timeron1.substring(3,5);
                       var timeset1 = hour1+minute1+"00";
                       var updates = {};
                       updates['/<?php echo $result["userid"]; ?>/device/relay220v1/endtime'] = timeset1;
                       updates['/<?php echo $result["userid"]; ?>/device/relay220v1/starttime'] = timeset;
                       return firebase.database().ref().update(updates);
                  });

                  $("#timestart2").click(function(e) {
                       var timeron = $("#timeron2").val();
                       var hour = timeron.substring(0,2);
                       var minute = timeron.substring(3,5);
                       var timeset = hour+minute+"00";
                       var timeron1 = $("#timeroff2").val();
                       var hour1 = timeron1.substring(0,2);
                       var minute1 = timeron1.substring(3,5);
                       var timeset1 = hour1+minute1+"00";
                       var updates = {};
                       updates['/<?php echo $result["userid"]; ?>/device/relay220v2/starttime'] = timeset;
                       updates['/<?php echo $result["userid"]; ?>/device/relay220v2/endtime'] = timeset1;
                       return firebase.database().ref().update(updates);

                  });

                  $("#timestart3").click(function(e) {
                       var timeron = $("#timeron3").val();
                       var hour = timeron.substring(0,2);
                       var minute = timeron.substring(3,5);
                       var timeset = hour+minute+"00";
                       var timeron1 = $("#timeroff3").val();
                       var hour1 = timeron1.substring(0,2);
                       var minute1 = timeron1.substring(3,5);
                       var timeset1 = hour1+minute1+"00";
                       var updates = {};
                       updates['/<?php echo $result["userid"]; ?>/device/relay220v3/starttime'] = timeset;
                       updates['/<?php echo $result["userid"]; ?>/device/relay220v3/endtime'] = timeset1;
                       return firebase.database().ref().update(updates);
                       });

                  $("#timestart4").click(function(e) {
                       var timeron = $("#timeron4").val();
                       var hour = timeron.substring(0,2);
                       var minute = timeron.substring(3,5);
                       var timeset = hour+minute+"00";
                       var timeron1 = $("#timeroff4").val();
                       var hour1 = timeron1.substring(0,2);
                       var minute1 = timeron1.substring(3,5);
                       var timeset1 = hour1+minute1+"00";
                       var updates = {};
                       updates['/<?php echo $result["userid"]; ?>/device/relay220v4/starttime'] = timeset;
                       updates['/<?php echo $result["userid"]; ?>/device/relay220v4/endtime'] = timeset1;
                       return firebase.database().ref().update(updates);
                  });

                  $("#timestart5").click(function(e) {
                       var timeron = $("#timeron5").val();
                       var hour = timeron.substring(0,2);
                       var minute = timeron.substring(3,5);
                       var timeset = hour+minute+"00";
                       var timeron1 = $("#timeroff5").val();
                       var hour1 = timeron1.substring(0,2);
                       var minute1 = timeron1.substring(3,5);
                       var timeset1 = hour1+minute1+"00";
                       var updates = {};
                       updates['/<?php echo $result["userid"]; ?>/device/relay12v1/endtime'] = timeset1;
                       updates['/<?php echo $result["userid"]; ?>/device/relay12v1/starttime'] = timeset;
                       return firebase.database().ref().update(updates);
                        });

                    $("#timestart6").click(function(e) {
                         var timeron = $("#timeron6").val();
                         var hour = timeron.substring(0,2);
                         var minute = timeron.substring(3,5);
                         var timeset = hour+minute+"00";
                         var timeron1 = $("#timeroff6").val();
                         var hour1 = timeron1.substring(0,2);
                         var minute1 = timeron1.substring(3,5);
                         var timeset1 = hour1+minute1+"00";
                         var updates = {};
                         updates['/<?php echo $result["userid"]; ?>/device/relay12v2/endtime'] = timeset1;
                         updates['/<?php echo $result["userid"]; ?>/device/relay12v2/starttime'] = timeset;
                         return firebase.database().ref().update(updates);
                          });

                      $("#timestart7").click(function(e) {
                           var timeron = $("#timeron7").val();
                           var hour = timeron.substring(0,2);
                           var minute = timeron.substring(3,5);
                           var timeset = hour+minute+"00";
                           var timeron1 = $("#timeroff7").val();
                           var hour1 = timeron1.substring(0,2);
                           var minute1 = timeron1.substring(3,5);
                           var timeset1 = hour1+minute1+"00";
                           var updates = {};
                           updates['/<?php echo $result["userid"]; ?>/device/relay5v1/endtime'] = timeset1;
                           updates['/<?php echo $result["userid"]; ?>/device/relay5v1/starttime'] = timeset;
                           return firebase.database().ref().update(updates);
                            });

                        $("#timestart8").click(function(e) {
                             var timeron = $("#timeron8").val();
                             var hour = timeron.substring(0,2);
                             var minute = timeron.substring(3,5);
                             var timeset = hour+minute+"00";
                             var timeron1 = $("#timeroff8").val();
                             var hour1 = timeron1.substring(0,2);
                             var minute1 = timeron1.substring(3,5);
                             var timeset1 = hour1+minute1+"00";
                             var updates = {};
                             updates['/<?php echo $result["userid"]; ?>/device/relay5v2/endtime'] = timeset1;
                             updates['/<?php echo $result["userid"]; ?>/device/relay5v2/starttime'] = timeset;
                             return firebase.database().ref().update(updates);
                              });

                        $("#fishfeed").click(function(e) {
                          var timeron = $("#timefeed").val();
                          var hour = timeron.substring(0,2);
                          var minute = timeron.substring(3,5);
                          var timeset = hour+minute+"00";
                          var timeron1 = $("#valuefeed").val();

                          var updates = {};
                          updates['/<?php echo $result["userid"]; ?>/device/feedend'] = timeron1;
                          updates['/<?php echo $result["userid"]; ?>/device/feedstart'] = timeset;
                          return firebase.database().ref().update(updates);
                           });

                           $("#setmoisture").click(function(e) {
                             var moisture = $("#valuemoisture").val();
                             var updates = {};

                             updates['/<?php echo $result["userid"]; ?>/device/moisture'] = moisture;
                             return firebase.database().ref().update(updates);
                              });
});


  WaterTemp.on('value', function(snapshot) {
  //console.log("Humid : "+snapshot.val())
  if(snapshot.val() <= 100 && snapshot.val() >= 0){
  g1.refresh(snapshot.val());
  }
  });

  PHvalue.on('value', function(snapshot) {
  //console.log("Humid : "+snapshot.val())
  if(snapshot.val() <= 100 && snapshot.val() >= 0){
  g2.refresh(snapshot.val());
  }
});
  ECvalue.on('value', function(snapshot) {
  //console.log("Humid : "+snapshot.val())
  if(snapshot.val() <= 2000 && snapshot.val() >= 100){
  g3.refresh(snapshot.val());
  }
});
  WaterLevel.on('value', function(snapshot) {
  //console.log("Humid : "+snapshot.val())
  if(snapshot.val() <= 100 && snapshot.val() >= 0){
  g4.refresh(snapshot.val());
  }
});
  AirTemp.on('value', function(snapshot) {
  //console.log("Humid : "+snapshot.val())
  if(snapshot.val() <= 100 && snapshot.val() >= 0){
  g5.refresh(snapshot.val());
  }
});
  AirHumid.on('value', function(snapshot) {
  //console.log("Humid : "+snapshot.val())
  if(snapshot.val() <= 100 && snapshot.val() >= 0){
  g6.refresh(snapshot.val());
  }
});
  SoilMois.on('value', function(snapshot) {
//  console.log("Temp : "+snapshot.val())
  if(snapshot.val() <= 100 && snapshot.val() >= 0){
  g7.refresh(snapshot.val());
  }
});


 var WaterTemp = 0;
  var g1 = new JustGage({
    id: "gauge1",
    value: WaterTemp,
    min: 0,
    max: 100,
    title: "WaterTemperature",
  });
  var PHvalue = 0;
  var g2 = new JustGage({
    id: "gauge2",
    value: PHvalue,
    min: 0,
    max: 14,
    title: "PH",
  });
  var ECvalue = 0;
  var g3 = new JustGage({
    id: "gauge3",
    value: ECvalue,
    min: 0,
    max: 2000,
    title: "EC",
  });
  var WaterLevel = 0;
  var g4 = new JustGage({
    id: "gauge4",
    value: WaterLevel,
    min: 0,
    max: 100,
    title: "WaterLevel",
  });
  var AirTemp = 0;
  var g5 = new JustGage({
    id: "gauge5",
    value: AirTemp,
    min: 0,
    max: 100,
    title: "Temperature",
  });
  var AirHumid = 0;
  var g6 = new JustGage({
    id: "gauge6",
    value: AirHumid,
    min: 0,
    max: 100,
    title: "Humidity",
  });
  var SoilMois = 0;
  var g7 = new JustGage({
    id: "gauge7",
    value: SoilMois,
    min: 0,
    max: 100,
    title: "Soilmoisture",
  });

</script>
