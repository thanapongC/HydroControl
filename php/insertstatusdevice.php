<?php
	session_start();
	include("connect.php");

	$sql = "UPDATE tbl_lamp SET
	statdevice = '".$_POST["timestart"]."'
	WHERE userid = '".$_POST["txtuserid"]."'
	AND keyid = '".$_POST["txtkeyid"]."' ";

	$query = mysqli_query($conn,$sql);

	if($query) {
		echo "<meta http-equiv='refresh' content='0;URL=../pages/index.php'>";
		exit();

	}
	mysqli_close($conn);
?>
