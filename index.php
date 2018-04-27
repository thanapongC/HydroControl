<?php
session_start();
if($_SESSION["status"] == "2")
{
  if($_SESSION["mode"] == "")
  {
    header("location:pages/mode.php");
  }else{
    header("location:pages/index.php");
  }
}
if($_SESSION["status"] == "1")
{
  header("location:pages/admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Log In</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background-color: #93cc01; font-family: 'Vollkorn', serif;">

    <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="col-lg-12" style="text-align: center;">
            <img src="img/biologisch-icoon.png" width="150px" height="150px">
          </div>
          </div>
            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default" style="border-color:#04D7AD; border-color:#00BF9A;">
                    <div class="panel-heading" style="background-color: #00BF9A; color:white; text-align:center">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">


                            <form action="php/check_login.php" method="post">
                                                    <div class="form-group">
                                                        <label for="username">Username</label>
                                                            <input type="username" class="form-control" name="username" id="inputSuccess" placeholder="Username" required autofocus style="border-color:#04D7AD">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                            <input type="password" class="form-control" name="password" id="inputSuccess" placeholder="Password" required autofocus style="border-color:#04D7AD">
                                                            </div>
                                                            <div class="checkbox">
                                                       <label>
                                                       <input name="remember" type="checkbox" value="Remember Me">Remember Me   </label>
                                                       <div style="text-align:center"><br>
                                                            <input type="submit" value="Log In" class="btn btn-primary" style="background-color: #00BF9A;  border-color:#00BF9A ;" >
                                                          <input type="button" value="Register" class="btn btn-primary"  data-toggle="modal" data-target="#register" style="background-color: #00BF9A;  border-color:#00BF9A ;" >
                                                        </div>
                                                    </form>
                                                  <!-- <input class="btn btn-primary" type="submit" name="Submit" value="Register Now" onclick="return confirm('คุณต้องการยืนยันการสมัครสมาชิก ?');" style="background-color: #00BF9A; border-color:#00BF9A" > -->
                                      </div>
                             </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-offset-4" style="color:white;text-align: center;font-family: 'Coiny', cursive;">

              <h3>Powered by </h3><hr>
              <h3>Connector Co.,LTD</h3>
            </div>
        </div>
    </div>

    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
         <div class="modal-header" style="background-color:#00BF9A; text-align:center">
           <h4 class="modal-title" id="exampleModalLongTitle">Register</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body" style="color:#000000;">
           <form action="php/insertacceptuser.php" method="post">
               <div class="form-group">
                 <label for="name" ><font color="red">*</font>Name :</label>
                 <input  class="form-control"  type="text" name="name" placeholder="Enter Your Name" style="border-color:#00BF9A;"required>
              </div>
              <div class="form-group">
                <label for="username" ><font color="red">*</font>Username :</label>
                <input  class="form-control"  type="text" name="username" placeholder="Enter Your Username" style="border-color:#00BF9A;"required>
             </div>
             <div class="form-group">
               <label for="password" ><font color="red">*</font>Password :</label>
               <input  class="form-control"  type="text" name="password" placeholder="Enter Your Password" style="border-color:#00BF9A;"required>
            </div>
             <div class="form-group">
                 <label for="deviceid"><font color="red">*</font>Select Device :</label><br>
                 <font color="black">
             <select type="text" name="deviceid"  class="form-control" style="border-color:#00BF9A;"required>

                    <option value="1">Hydroponic</option>
                    <option value="3">Aquaponic</option>
                    <option value="2">Basket Of Grow</option>

        </select>
       </font>
             </div>

         </div>
         <div class="modal-footer" style="background-color:#00BF9A;">

           <button type="submit" class="btn btn-primary"  onclick="return confirm('Wait for confirmation from Admin');" style="color:#00BF9A;background-color:#FFFFFF;border-color:#FFFFFF">Save changes</button>
         </div>
         </form>
       </div>
     </div>
    </div>
    <!-- / End Model -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
