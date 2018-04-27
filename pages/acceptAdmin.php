<?php
session_start();
include "../php/connect.php";
if($_SESSION['userid'] == "")
{
   header("location:../index.php");
   exit();
}

if($_SESSION['status'] != "1")
{
  echo "This page for Admin only!";

   //header("location:../SmartLightUp/login");
  exit();
}
$sql = "SELECT * FROM tbl_user WHERE userid = '{$_SESSION["userid"]}'";

$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query);
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
                            <a href="admin.php"></i> <font color="black">All User</font></a>
                        </li>
                        <li>
                            <a href="acceptAdmin.php"></i> <font color="black">Wait for confirmation</font></a>
                        </li>
                    </ul>
            </div>
            </div>
        </nav>



        <div id="page-wrapper"><br>
            <div class="row">

                <div class="col-lg-12">
                  <!-- Start water sensor -->
                              <div class="panel panel-default" >
                                <div class="panel-heading" style="background-color: #00BF9A;">
                                  <h4>
                                    <i class="fa fa-tint fa-fw" style="color:white"></i>
                                    <font color="#FAFAFA">All User</font>
                                  </h4>


                                </div>
                                <?php
                                    $sqlacuser = "SELECT * FROM tbl_acceptuser ";
                                    $queryacuser = mysqli_query($conn, $sqlacuser);
                                  ?>
                                <div class="row"  style='display: flex; justify-content: center;flex-wrap: wrap;'>


                                    <div class="col-lg-4 col-xs-11">
                                      <br>
                                      <div class="table-responsive-sm">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>

                                                    <th>Username</th>

                                                    <th>Devices</th>
                                                    <th><center>Confirm</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php  $i = 0;while ($resultacuser = mysqli_fetch_array($queryacuser, MYSQLI_ASSOC)) {?>
                                                     <tr>
                                                       <form <form action="../php/insertuser.php" method="post">
                                                         <td><?php echo $resultacuser["name"];?>
                                                         <input type="hidden" name="name" value="<?php echo $resultacuser["name"];?>"></td>
                                                         <td><?php echo $resultacuser["username"];?>
                                                         <input type="hidden" name="username" value="<?php echo $resultacuser["username"];?>"></td>

                                                         <?php if($resultacuser["deviceid"] == 1){?>
                                                         <td>Hydroponic
                                                        </td>
                                                         <?php }?>
                                                         <?php if($resultacuser["deviceid"] == 2){?>
                                                         <td>Aquaponic
                                                      </td>
                                                         <?php }?>
                                                         <?php if($resultacuser["deviceid"] == 3){?>
                                                         <td>Basket Of Grow
                                                      </td>
                                                         <?php }?>
                                                        <input type="hidden" name="deviceid" value="<?php echo $resultacuser["deviceid"];?>">
                                                        <input type="hidden" name="mode" value="auto">
                                                        <input type="hidden" name="apikey" value="AIzaSyAyNg8n9XuHlJabskY5thWoJ_ZRH8QEf7E">
                                                        <input type="hidden" name="authDomain" value="basketofgrow.firebaseapp.com">
                                                        <input type="hidden" name="databaseURL" value="https://basketofgrow.firebaseio.com">
                                                        <input type="hidden" name="projectId" value="basketofgrow">
                                                        <input type="hidden" name="storageBucket" value="basketofgrow.appspot.com">
                                                        <input type="hidden" name="messagingSenderId" value="1096561079387">
                                                        <input type="hidden" name="acuserid" value="<?php echo $resultacuser["acUserid"];?>">
                                                         <td><center><button type="submit" class="btn btn-warning btn-circle" ><i class="fa fa-check"></i></td>
                                                         </form>
                                                     </tr>
                                              <?php $i++; }?>
                                           </tbody>
                                      </table>
                                    </div>
                                  <br>
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
