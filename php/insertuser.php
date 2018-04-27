<?php
	session_start();
	include("connect.php");


	$sql = "INSERT INTO tbl_user (name, username, password, deviceid, mode, apiKey, authDomain, databaseURL, projectId,
	storageBucket, messagingSenderId)
			VALUES ('".$_POST["name"]."','".$_POST["username"]."','".$_POST["password"]."','".$_POST["deviceid"]."'
			,'".$_POST["mode"]."','".$_POST["apikey"]."','".$_POST["authDomain"]."','".$_POST["databaseURL"]."'
		,'".$_POST["projectId"]."','".$_POST["storageBucket"]."','".$_POST["messagingSenderId"]."')";

  $acuserid = $_POST["acuserid"];
	$query = mysqli_query($conn,$sql);

	if($query) {
		$message = "Record add successfully!";
		echo "<script type='text/javascript'>alert('$message');</script>";

		$sql = "DELETE FROM tbl_acceptuser

		WHERE acUserid = '".$acuserid."' ";

		$query = mysqli_query($conn,$sql);

		if(mysqli_affected_rows($conn)) {
			 echo "Record delete successfully";
		 }

		echo "<meta http-equiv='refresh' content='0;URL=../pages/acceptAdmin.php'>";
		exit();
	}
	mysqli_close($conn);
?>
