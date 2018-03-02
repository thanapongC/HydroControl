<?php 
session_start();
	include("connect.php");
	$usern = null;

	if (isset($_GET["userid"])) 
	{
		$usern = $_GET["userid"];	
	}

	$sql = "SELECT * FROM tbl_user WHERE userid='".$usern."'";
	$query = mysqli_query($conn,$sql);
	$result = mysqli_fetch_array($query,MYSQLI_ASSOC);

 ?>

<?php
  session_start();
  include("connect.php");
  if($_SESSION['userid'] == "")
  {
     header("location:../hydropronic/index.php");
     exit();
  }
  if($_SESSION['status'] != "1")
  {
   // echo "This page for Admin only!";
    $message = "This page for Admin only!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
    exit();
  } 
 ?>

<?php 
   session_start();
   include("connect.php");
   $sql = "SELECT * FROM tbl_user WHERE userid= '{$_SESSION["userid"]}'";
   $query = mysqli_query($conn,$sql);
   $name = $_SESSION["name"];
 
 ?>

<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Hydro IoT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by GetTemplates.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="GetTemplates.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="savory/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="savory/css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="savory/css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="savory/css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="savory/css/magnific-popup.css">

	<!-- Bootstrap DateTimePicker -->
	<link rel="stylesheet" href="savory/css/bootstrap-datetimepicker.min.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="savory/css/owl.carousel.min.css">
	<link rel="stylesheet" href="savory/css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="savory/css/style.css">

	<!-- Modernizr JS -->
    <script src="savory/js/modernizr-2.6.2.min.js"></script>
    

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <!--<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">-->
  <!--<link rel="stylesheet" href="../bootstrap/css/w3.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>The Lighting On and Off System Via Internet</title> 
    <script src="../jquery-1.11.3.min.js"></script>
    <script src="../mqttws31.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/magnific-popup.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/templatemo-style.css">
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>

	<div class="gtco-loader"></div>

	<div id="page">


	<!-- <div class="page-inner"> -->
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">

			<div class="row">
				<div class="col-sm-2 col-xs-12">
					<div id="gtco-logo"><a href="menu.php">Hydro <em>IoT</em></a> </div>
				</div>
				<div class="col-xs-10 text-right menu-1">
					<ul>
					
            <li class="btn-cta"><a href="logout.php" onclick="return confirm('คุณต้องการออกจากระบบ ?');" ><span><?php echo$_SESSION["name"];?>  |  Sign Out</span></a></li>
          
					</ul>
				</div>
			
			</div>    

		</div>
	</nav>

	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_1.jpg)" data-stellar-background-ratio="0.5">
	</header>

	<div id="gtco-features">

		<div class="gtco-container">
    <div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
					<h2 class="cursive-font">Edit User</h2> 
					<p>.....</p>
				</div>
			</div>

			<div class="row" >
				<div class="col-md-12 col-sm-12">
					<div class="feature-center animate-box" data-animate-effect="fadeIn" >
        

	
	<form action="page_saveuser.php" name="frmediteuser" method="post">

	
		<table class="w3-table-all w3-hoverable" border="0" width="250" >
			<thead>
				<tr>
					<th width="250">Userid</th>
					<td width="250">
						<input type="text" name="txtuserid" value="<?php echo $result["userid"]?>">
					</td>
				</tr>
				<tr>	
					<th width="250">Username</th>
					<td width="250">
						<input type="text" name="txtusername" value="<?php echo $result["username"];?>">
					</td>
				</tr>
				<tr>
					<th width="250">Password</th>
					<td width="250">
					   	<input type="text" name="txtpassword" value="<?php echo $result["password"];?>">
					</td>
				</tr>
				<tr>
					<th width="250">Name</th>
					<td width="250">
						<input type="text" name="txtname" value="<?php echo $result["name"];?>">
					</td>
				</tr>
				<tr>
					<th width="250">Userc</th>
					<td width="250">
						<input  class="text" name="txtuserc" type="text" value="<?php echo $result["userc"];?>">
					</td>
				</tr>
				<tr>
					<th width="250">Passwordc</th>
					<td width="250">
						<input type="text" name="txtpasswordc" value="<?php echo $result["passwordc"];?>"> 
					</td>
				</tr>
				<tr>
					<th width="250">Status</th>
					<td width="250">
						<input type="text" name="txtstatus" value="<?php echo $result["status"];?>">						
					</td>
				</tr>
				
			</thead>
		</table> 
		<br>	
		<input type="submit" class="btn btn-primary" value="Save">
			
			</form>

			<?php 
			mysqli_close($conn); 
			?>

</div>
</div>
</div>
</div>
</div>
</div>


	


	<footer id="gtco-footer" role="contentinfo" style="background-image: url(images/img_bg_1.jpg)" data-stellar-background-ratio="0.5"></footer>
	<!-- </div> -->

	</div>


   

	<!-- jQuery -->
	<script src="savory/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="savory/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="savory/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="savory/js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="savory/js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="savory/js/jquery.countTo.js"></script>

	<!-- Stellar Parallax -->
	<script src="savory/js/jquery.stellar.min.js"></script>

	<!-- Magnific Popup -->
	<script src="savory/js/jquery.magnific-popup.min.js"></script>
	<script src="savory/js/magnific-popup-options.js"></script>

	<script src="savory/js/moment.min.js"></script>
	<script src="savory/js/bootstrap-datetimepicker.min.js"></script>


	<!-- Main -->
	<script src="savory/js/main.js"></script>

	</body>
</html>
