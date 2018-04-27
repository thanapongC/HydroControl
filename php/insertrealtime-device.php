<?php
	session_start();
	include("connect.php");


	$sql = "INSERT INTO tbl_realtime (devicename, keyid, userid, devicetype)
			VALUES ('".$_POST["devicename"]."','".$_POST["deviceid"]."','".$_POST["txtuserid"]."','".$_POST["txtdevicetype"]."')";

	$query = mysqli_query($conn,$sql);

	if($query) {
		$message = "Record add successfully!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<meta http-equiv='refresh' content='0;URL=../pages/index.php'>";
		exit();
	}
	mysqli_close($conn);
?>
