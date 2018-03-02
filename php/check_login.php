<?php
	session_start();
	include("connect.php");

	$_POST['username'] = mysqli_real_escape_string($conn,$_POST['username']);
	$_POST['password'] = mysqli_real_escape_string($conn,$_POST['password']);
	//$us = mysqli_real_escape_string($conn, $_POST['username']);
	//$pa = mysqli_real_escape_string($conn, $_POST['password']);


	$strSQL = "SELECT * FROM tbl_user WHERE username = '".$_POST['username']."' 
			 						  and	password = '".$_POST['password']."' ";
	$query = mysqli_query($conn, $strSQL);
	$result = mysqli_fetch_array($query);
	if(!$result)
	{
			//echo "Username And Password Incorrect!";
			$message = "Username And Password Incorrect!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo "<meta http-equiv='refresh' content='0;URL=../index.php'>";
	}
	else
	{
			$_SESSION["userid"] = $result["userid"];
			$_SESSION["name"] = $result["name"];
			$_SESSION["userc"] = $result["userc"];
			$_SESSION["passwordc"] = $result["passwordc"];
			$_SESSION["status"] = $result["status"];

			session_write_close();
			
			if($result["status"] == "1")
			{
				header("location:../pages/admin.php");
				//header("location:../list_main.php");
			}
			if($result["status"] == "2")
			{
				header("location:../pages/index.php");
			}

		}
		
	mysqli_close($conn);
?>

<!--
	//'or '1'='1
-->
