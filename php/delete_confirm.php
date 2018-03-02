<?php session_start(); ?>
<html>
<head>
<title>Delete_Confirm</title>
<meta charset="utf-8">
</head>
<body>
<?php
	include("connect.php");

	$strPortID = $_GET["portid"];
	$sql = "DELETE FROM tbl_lamp

			WHERE portid = '".$strPortID."' ";

	$query = mysqli_query($conn,$sql);

	if(mysqli_affected_rows($conn)) {
		 echo "Record delete successfully";
		?>
<script>

    window.location = "../pages/index.php";

</script>
		<?php
}

	mysqli_close($conn);
?>
</body>
</html>
