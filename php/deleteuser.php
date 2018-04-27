<?php session_start(); ?>
<html>
<head>
<title>Delete_Confirm</title>
<meta charset="utf-8">
</head>
<body>
<?php
	include("connect.php");

	$userid = $_POST["userid"];
	$sql = "DELETE FROM tbl_user

			WHERE userid = '".$userid."' ";

	$query = mysqli_query($conn,$sql);

	if(mysqli_affected_rows($conn)) {
		 echo "Record delete successfully";
		?>
<script>

    window.location = "../pages/admin.php";

</script>
		<?php
}

	mysqli_close($conn);
?>
</body>
</html>
