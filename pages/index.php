<?php
session_start();
include "../php/connect.php";
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
?>
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

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

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

<body>

    <div id="wrapper" style="background-color: #00BF9A; font-family: 'Vollkorn', serif;">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #00BF9A;" >
            <div class="navbar-header" style="background-color: #00BF9A;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" >
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><font color="#FAFAFA">HYDRO-DESHBROAD PANEL</font></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right" >

                <!-- /.dropdown -->
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
                    <!-- /.dropdown-user -->
                </li>

                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw" style="color:black;"></i> <font color="black"> Dashboard</font></a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper"><br>
            <div class="row">

 <!-- start air sensor -->
            <?php
            $sqlrealtimeair = "SELECT * FROM tbl_realtime WHERE userid={$_SESSION["userid"]} AND devicetype = 'Air' ";
            $queryrealtimeair = mysqli_query($conn, $sqlrealtimeair);
            $resultair  = mysqli_query($conn, $sqlrealtimeair);
            $numair = mysqli_num_rows($resultair);?>
                <div class="col-lg-8">
                  <!-- Start water sensor -->
                                        <?php
                        $sqlrealtimewater = "SELECT * FROM tbl_realtime WHERE userid={$_SESSION["userid"]} AND devicetype = 'Water' ";
                        $queryrealtimewater = mysqli_query($conn, $sqlrealtimewater);
                        $resultwater  = mysqli_query($conn, $sqlrealtimewater);
                        $numwater = mysqli_num_rows($resultwater);
                             ?>

                                <div class="panel panel-default" >
                                <div class="panel-heading" style="background-color: #00BF9A;">
                                <i class="fa fa-tint fa-fw" style="color:white"></i> <font color="#FAFAFA">Water Sensor</font>
                                <div class="pull-right">
                                <button type="button" class="btn btn-warning btn-circle" name="adddevice" data-toggle="modal" data-target="#watersensor"><i class="fa fa-plus-circle"></i>
                              </div><hr>
                            </div>
                                <div class="row"  style='display: flex; justify-content: center;flex-wrap: wrap;'>
                                               <?php $i = 0;while ($resultrealtimewater = mysqli_fetch_array($queryrealtimewater, MYSQLI_ASSOC)) {?>
                                               <div class="col-lg-2 col-xs-10">
                                                   <br>
                                                   <a href="../php/delete_confirm2.php?portid=<?php echo $resultrealtimewater["portid"]; ?>" onclick="return confirm('คุณต้องการลบข้อมูล ?');">

                                                   <div class="panel panel-default">
                                                      <div class="panel-heading" style="background-color: #00BF9A;">
                                                  <center><font color="#FAFAFA"> <?php echo $resultrealtimewater["devicename"]; ?></font> <center>

                                                 </div><br>

                                               <?php echo "<div id='gauge" . $resultrealtimewater["keyid"] . "' class='200x160px'>";
                                                     echo "</div>";?>

                                                      </div>
                                                    </a>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                               <?php $i++;?>
                                               <?php }?>
                                               <?php
                                              if($numwater == 0){
                                                  echo " <h3>None</h3> ";
                                              }
                                              ?>

                                </div>
   </div>


                            <!-- /end water sensor -->
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: #00BF9A;">
                            <i class="fa fa-soundcloud fa-fw" style="color:white"></i> <font color="#FAFAFA">Air Sensor</font>
                        </div>
                             <div class="row"  style='display: flex; justify-content: center;flex-wrap: wrap;'>
                              <?php $i = 0;while ($resultrealtimeair = mysqli_fetch_array($queryrealtimeair, MYSQLI_ASSOC)) {?>

                               <div class="col-xs-10 col-lg-4"><br>
                                 <a href="../php/delete_confirm2.php?portid=<?php echo $resultrealtimeair["portid"]; ?>" onclick="return confirm('คุณต้องการลบข้อมูล ?');">

                                 <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: #00BF9A;">
                      <center><font color="#FAFAFA"><?php echo $resultrealtimeair["devicename"]; ?></font></center>

                        </div><br>

                          <?php echo "<div id='gauge" . $resultrealtimeair["keyid"] . "' class='200x160px'>";
                          echo "</div>";?>
                                   <br>


          </div>
        </a>

      </div>&nbsp;&nbsp;&nbsp;&nbsp;

                      <?php $i++;?>
                      <?php }?>

                        <?php
                              if($numair == 0){
                                  echo "<h3>None</h3> ";
                              }
                              ?>

        </div>




        <!-- /end air sensor -->




 </div>
 <div class="panel panel-default">
   <div class="panel-heading" style="background-color: #00BF9A;">
   <i class="fa fa-power-off fa-fw" style="color:white"></i> <font color="#FAFAFA">ON-OFF Device Panel</font>
   <div class="pull-right">
   <button type="button" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#onoffdevice"><i class="fa fa-plus-circle"></i>
   </div><hr>
 </div>
     <div class="panel-body">
         <div class="list-group">
         <?php
           $sql = "SELECT * FROM tbl_lamp WHERE userid='{$_SESSION["userid"]}'";
           $query = mysqli_query($conn, $sql);
         ?>
         <?php $i = 0;while ($resultonoff = mysqli_fetch_array($query, MYSQLI_ASSOC)) {?>
             <div class="row">



                 <div class="col-lg-7 col-xs-6">

                     <a href="../php/delete_confirm.php?portid=<?php echo $resultonoff["portid"]; ?>" onclick="return confirm('คุณต้องการลบข้อมูล ?');">
                          <font color="black"><?php echo $resultonoff["lampname"]; ?></font>
                     </a>

                 </div>
                 <div class="col-lg-2 col-xs-3">
                       <button id="led-on" onclick="on<?php echo $resultonoff["keyid"]; ?>();"type="button" class="btn btn-success btn-circle btn-lg" id="timestart<?php echo $resultset["keyid"];?>"  name="timestart"><i class="fa fa-power-off"></i>
                 </div>
                 <div class="col-lg-2 col-xs-3">
                     <button id="led-off"  type="button"  onclick="off<?php echo $resultonoff["keyid"]; ?>();" class="btn btn-danger btn-circle btn-lg" id="timestart<?php echo $resultset["keyid"];?>"  name="timestart"><i class="fa fa-power-off"></i>
                 </div>
         </div><hr>


          <?php $i++;?>
          <?php }?>

         </div>
         <!-- /.list-group -->
     </div>
     <!-- /.panel-body -->
 </div>
                </div>
                <!-- /.col-lg-8 -->

                <div class="col-lg-4">
                  <!-- start soil sensor -->
                  <?php
                  $sqlrealtimesoil = "SELECT * FROM tbl_realtime WHERE userid={$_SESSION["userid"]} AND devicetype = 'Soil' ";
                  $queryrealtimesoil = mysqli_query($conn, $sqlrealtimesoil);
                  $resultsoil  = mysqli_query($conn, $sqlrealtimesoil);
                  $numsoil = mysqli_num_rows($resultsoil); ?>

                      <div class="panel panel-default">
                      <div class="panel-heading" style="background-color: #00BF9A;">
                      <i class="fa fa-pagelines fa-fw" style="color:white"></i> <font color="#FAFAFA">Soil Sensor</font>
                    </div>
                      <div class="row" style='display: flex; justify-content: center;flex-wrap: wrap;'>

                                     <?php $i = 0;while ($resultrealtimesoil = mysqli_fetch_array($queryrealtimesoil, MYSQLI_ASSOC)) {?>
                                     <div class="col-xs-10 col-lg-10"> <br>
                                       <a href="../php/delete_confirm2.php?portid=<?php echo $resultrealtimesoil["portid"]; ?>" onclick="return confirm('คุณต้องการลบข้อมูล ?');">

                                       <div class="panel panel-default">
                                          <div class="panel-heading" style="background-color: #00BF9A;">
                                              <center><font color="#FAFAFA"><?php echo $resultrealtimesoil["devicename"]; ?></center><center>

                                         </div><br>

                                   <?php


                                     echo "<div id='gauge" . $resultrealtimesoil["keyid"] . "' class='200x160px'>";
                                     echo "</div>";
                                   ?>

                            </div>
                          </a>

                      </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                     <?php $i++;?>
                                     <?php }?>

                                    <?php
                                    if($numsoil == 0){
                                        echo "<h3>None</h3> ";
                                    }
                                    ?>
                      </div>
                      </div>



                  <!-- /end soil sensor -->




                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: #00BF9A;">
                            <i class="fa fa-clock-o fa-fw" style="color:white"></i> <font color="#FAFAFA">Devices Time Setting</font>
                        </div>
                        <?php
                              $sqlset = "SELECT * FROM tbl_lamp WHERE userid='{$_SESSION["userid"]}'";
                              $queryset = mysqli_query($conn, $sqlset);
                            ?>
                        <div class="panel-body">

                        <?php $i = 0;while ($resultset = mysqli_fetch_array($queryset, MYSQLI_ASSOC)) {?>

                        <div class="row">

                          <div class="col-lg-3 col-xs-3">


                                 <font color="black">  <?php echo $resultset["lampname"]; ?></font>


                          </div>

                          <div class="col-lg-1 col-xs-1">
                            <div class="row">
                              <div class="col-lg-6 col-xs-6">
                              <img src="../img/timen.jpg">
                            </div>
                          </div><br>
                            <div class="row">
                              <div class="col-lg-6 col-xs-6">
                              <img src="../img/timef.jpg">
                            </div>
                            </div>
                          </div>

                        <div class="col-lg-5 col-xs-5">
                          <div class="form-group has-success">

                            <input class="form-control"  type="time" id="timeron<?php echo $resultset["keyid"];?>" name="timeron" required>
                          </div>
                          <div class="form-group has-error">

                            <input class="form-control"  type="time" id="timeroff<?php echo $resultset["keyid"];?>" name="timeroff" required><br>
                          </div>
                        </div>


                        <div class="col-lg-2 col-xs-2">

                            <button type="button" class="btn btn-info btn-circle btn-lg" id="timestart<?php echo $resultset["keyid"];?>"  name="timestart"><i class="fa fa-send"></i>
                            </button>

                        </div>
                     </div>
                            <?php $i++;?>
                            <?php }?>

         </div>
         </div>
         </div>

         </div>
         </div>





    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- PHP -->
    <!-- Start Model -->
    <div class="modal fade" id="watersensor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLongTitle">Add Real-Time Device</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
         <form action="../php/insertrealtime-device.php" method="post">
                                                       <div class="form-group">
                                                         <label for="devicename" ><font color="red">*</font>Device Name :</label><br>
                                                             <input class="form-control"  type="text" name="devicename" size="10"  placeholder="Enter Device Name" >
                                                        </div>
                                                     <div class="form-group">
                                                         <label for="deviceid"><font color="red">*</font>Select Device</label><br>
                                                         <font color="black">
                                               <select class="form-control"  type="text" name="deviceid" required>

                                                  <!-- PHP -->

                                                         <?php while ($result3 = mysqli_fetch_array($query3)) { ?>
                                                            <option value="<?php echo $result3["id"]; ?>"><?php echo $result3["devicename"]; ?></option>

                                                          <?php } ?>
                                               </select>
                                               </font>
                                               </div>
                                               <div class="form-group">
                                               <label for="deviceid"><font color="red">*</font>Select Device Type</label><br>
                                           <select  class="form-control"  type="text" name="txtdevicetype" required>
                                               <option value="Water">Water Sensor</option>
                                               <option value="Soil">Soil Sensor</option>
                                               <option value="Air">Air Sensor</option>
                                           </select>
                                                         </div>
                                           <input type="hidden" name="txtuserid" size="20" required autofocus value="<?php echo $_SESSION["userid"]; ?>">



         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <?php echo $result3["devicetype"]; ?>
           <button type="submit" class="btn btn-primary"  onclick="return confirm('คุณต้องการเพื่มอุปกรณ์ ?');">Save changes</button>
         </div>
         </form>
       </div>
     </div>
   </div>

   <div class="modal fade" id="onoffdevice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add ON-OFF Device</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../php/insertdevice.php" method="post">
              <div class="form-group">
                <label for="devicename" ><font color="red">*</font>Device Name :</label>
                <input  class="form-control"  type="text" name="devicename" placeholder="Enter Device Name" required>
             </div>
            <div class="form-group">
                <label for="deviceid"><font color="red">*</font>Select Device :</label><br>
                <font color="black">
            <select type="text" name="deviceid"  class="form-control" required>

         <!-- PHP -->

                <?php while ($resultdevice = mysqli_fetch_array($querydevice)) {
                  ?>
                   <option value="<?php echo $resultdevice["id"]; ?>"><?php echo $resultdevice["devicename"]; ?></option>
                 <?php
               }
               ?>
       </select>
      </font>
               <input type="hidden" name="txtuserid" size="20" required autofocus value="<?php echo $_SESSION["userid"]; ?>">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <?php echo $result3["devicetype"]; ?>
          <button type="submit" class="btn btn-primary"  onclick="return confirm('คุณต้องการเพื่มอุปกรณ์ ?');">Save changes</button>
        </div>
        </form>
      </div>
    </div>
   </div>
   <!-- / End Model -->


      <div class="modal fade" id="userprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLongTitle">Your Profile</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <form action="../php/page_saveuser.php" name="frmediteuser" method="post">

              <div class="form-group">
                   <label for="devicename" >User ID :</label>
                          <input type="text" name="userid" value="<?php echo $result["userid"]?>"  class="form-control" disabled>
              </div>

              <div class="form-group">
                   <label for="devicename" >Username :</label>
                          <input type="text" name="username" value="<?php echo $result["username"];?>"  class="form-control" disabled>
               </div>
              <div class="form-group">
                  <label for="devicename" >Password :</label>
                         <input type="text" name="password" value="<?php echo $result["password"];?>"  class="form-control" disabled>
             </div>
              <div class="form-group">
                  <label for="devicename" >Name :</label>
                         <input type="text" name="name" value="<?php echo $result["name"];?>"  class="form-control" disabled>
              </div>
              <div class="form-group">
                   <label for="devicename" >API-Key :</label>
                          <input type="text" name="apiKey" value="<?php echo $result["apiKey"];?>"  class="form-control" disabled>
              </div>
              <div class="form-group">
                   <label for="devicename" >authDomain :</label>
                          <input type="text" name="authDomain" value="<?php echo $result["authDomain"];?>"  class="form-control" disabled>
              </div>
              <div class="form-group">
                   <label for="devicename" >databaseURL :</label>
                          <input type="text" name="databaseURL" value="<?php echo $result["databaseURL"];?>"  class="form-control" disabled>
              </div>
              <div class="form-group">
                   <label for="devicename" >projectId :</label>
                          <input type="text" name="projectId" value="<?php echo $result["projectId"];?>"  class="form-control" disabled>
              </div>
              <div class="form-group">
                   <label for="devicename" >storageBucket :</label>
                          <input type="text" name="storageBucket" value="<?php echo $result["storageBucket"];?>"  class="form-control" disabled>
              </div>
              <div class="form-group">
                   <label for="devicename" >messagingSenderId :</label>
                          <input type="text" name="messagingSenderId" value="<?php echo $result["messagingSenderId"];?>"  class="form-control" disabled>
              </div>

           <!-- <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <?php echo $result3["devicetype"]; ?>
             <button type="submit" class="btn btn-primary"  onclick="return confirm('คุณต้องการบันทึกข้อมูล ?');">Save changes</button>
           </div> -->
           </form>
         </div>
       </div>
      </div>
      <!-- / End Model -->



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
  //var database = firebase.database();
  var WaterTemp = firebase.database().ref("<?php echo $result["userid"]; ?>/value/WaterTemp");
  var PH = firebase.database().ref("<?php echo $result["userid"]; ?>/value/PH");
  var EC = firebase.database().ref("<?php echo $result["userid"]; ?>/value/EC");
  var WaterLevel = firebase.database().ref("<?php echo $result["userid"]; ?>/value/WaterLevel");
  var AirTemp = firebase.database().ref("<?php echo $result["userid"]; ?>/value/AirTemp");
  var AirHumid = firebase.database().ref("<?php echo $result["userid"]; ?>/value/AirHumid");
  var SoilMois = firebase.database().ref("<?php echo $result["userid"]; ?>/value/SoilMois");




//Light On-Off
                  function off1() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/light').set("off");
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/light').update("off");
                  }
                  function on1() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/light').set("on");
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/light').update("on");
                  }
                    //Electric Fan On-Off
                  function off2() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/electricfan').set("off");
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/electricfan').update("off");
                  }
                  function on2() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/electricfan').set("on");
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/electricfan').update("on");
                  }
                    //Spingker On-Off
                  function off3() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/spingker').set("off");
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/spingker').update("off");
                  }
                  function on3() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/spingker').set("on");
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/spingker').update("on");
                  }
                  //Heater On-Off
                  function off4() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/heater').set("off");
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/heater').update("off");
                  }
                  function on4() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/heater').set("on");
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/heater').update("on");
                  }
                  //Cooler On-Off
                  function off5() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/cooler').set("off");
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/cooler').update("off");
                  }
                  function on5() {
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/cooler').set("on");
                           return firebase.database().ref('/<?php echo $result["userid"]; ?>/device/cooler').update("on");
                  }




     /*-------    JQuery    --------*/

         $(document).ready(function(e) {

                  $("#timestart1").click(function(e) {
                       var timeron = $("#timeron1").val();
                       var timeron1 = $("#timeroff1").val();
                       var updates = {};
                       updates['/<?php echo $result["userid"]; ?>/device/light/endtime'] = timeron1;
                       updates['/<?php echo $result["userid"]; ?>/device/light/starttime'] = timeron;
                       return firebase.database().ref().update(updates);
                  });

                  $("#timestart2").click(function(e) {
                       var timeron = $("#timeron2").val();
                       var timeron1 = $("#timeroff2").val();
                       var updates = {};
                       updates['/<?php echo $result["userid"]; ?>/device/electricfan/starttime'] = timeron;
                       updates['/<?php echo $result["userid"]; ?>/device/electricfan/endtime'] = timeron1;
                       return firebase.database().ref().update(updates);

                  });

                  $("#timestart3").click(function(e) {
                       var timeron = $("#timeron3").val();
                       var timeron1 = $("#timeroff3").val();
                       var updates = {};
                       updates['/<?php echo $result["userid"]; ?>/device/spingker/starttime'] = timeron;
                       updates['/<?php echo $result["userid"]; ?>/device/spingker/endtime'] = timeron1;
                       return firebase.database().ref().update(updates);
                       });

                  $("#timestart4").click(function(e) {
                       var timeron = $("#timeron4").val();
                       var timeron1 = $("#timeroff4").val();
                       var updates = {};
                       updates['/<?php echo $result["userid"]; ?>/device/heater/starttime'] = timeron;
                       updates['/<?php echo $result["userid"]; ?>/device/heater/endtime'] = timeron1;
                       return firebase.database().ref().update(updates);
                  });

                  $("#timestart5").click(function(e) {
                       var timeron = $("#timeron5").val();
                       var timeron1 = $("#timeroff5").val();
                       var updates = {};
                       updates['/<?php echo $result["userid"]; ?>/device/cooler/endtime'] = timeron1;
                       updates['/<?php echo $result["userid"]; ?>/device/cooler/starttime'] = timeron;
                       return firebase.database().ref().update(updates);
                        });
                    });


  WaterTemp.on('value', function(snapshot) {
  //console.log("Humid : "+snapshot.val())
  if(snapshot.val() <= 100){
  g1.refresh(snapshot.val());
  }
  });

  PH.on('value', function(snapshot) {
  //console.log("Humid : "+snapshot.val())
  if(snapshot.val() <= 100){
  g2.refresh(snapshot.val());
  }
});
  EC.on('value', function(snapshot) {
  //console.log("Humid : "+snapshot.val())
  if(snapshot.val() <= 100){
  g3.refresh(snapshot.val());
  }
});
  WaterLevel.on('value', function(snapshot) {
  //console.log("Humid : "+snapshot.val())
  if(snapshot.val() <= 100){
  g4.refresh(snapshot.val());
  }
});
  AirTemp.on('value', function(snapshot) {
  //console.log("Humid : "+snapshot.val())
  if(snapshot.val() <= 100){
  g5.refresh(snapshot.val());
  }
});
  AirHumid.on('value', function(snapshot) {
  //console.log("Humid : "+snapshot.val())
  if(snapshot.val() <= 100){
  g6.refresh(snapshot.val());
  }
});
  SoilMois.on('value', function(snapshot) {
  //console.log("Temp : "+snapshot.val())
  if(snapshot.val() <= 100){
  g7.refresh(snapshot.val());
  }
});


 var WaterTemp = 0;
  var g1 = new JustGage({
    id: "gauge1",
    value: WaterTemp,
    min: 0,
    max: 100,
    title: "WaterTemperature"
  })
  var PH = 0;
  var g2 = new JustGage({
    id: "gauge2",
    value: PH,
    min: 0,
    max: 100,
    title: "PH"
  });
  var EC = 0;
  var g3 = new JustGage({
    id: "gauge3",
    value: EC,
    min: 0,
    max: 100,
    title: "EC"
  });
  var WaterLevel = 0;
  var g4 = new JustGage({
    id: "gauge4",
    value: WaterLevel,
    min: 0,
    max: 100,
    title: "WaterLevel"
  });
  var AirTemp = 0;
  var g5 = new JustGage({
    id: "gauge5",
    value: AirTemp,
    min: 0,
    max: 100,
    title: "Temperature"
  });
  var AirHumid = 0;
  var g6 = new JustGage({
    id: "gauge6",
    value: AirHumid,
    min: 0,
    max: 100,
    title: "Humidity"
  });
  var SoilMois = 0;
  var g7 = new JustGage({
    id: "gauge7",
    value: SoilMois,
    min: 0,
    max: 100,
    title: "Soilmoisture"
  });

</script>
