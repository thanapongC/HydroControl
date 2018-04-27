<?php
	session_start();
	include("connect.php");

	$sql = "INSERT INTO tbl_acceptuser (name, username, password, deviceid)
			VALUES ('".$_POST["name"]."','".$_POST["username"]."','".$_POST["password"]."','".$_POST["deviceid"]."')";

	$query = mysqli_query($conn,$sql);

	if($query) {
		$message = "Record add successfully!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<meta http-equiv='refresh' content='0;URL=../index.php'>";
		exit();

	}
	mysqli_close($conn);
?>
