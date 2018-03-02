<?php

if(!isset($_SESSION['userid'])){
	//echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
	header("location:/hydropronic/index.php");
}

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbName = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    echo("Connection failed: " . $conn->connect_error);
}
$sql ="SET NAMES UTF8";
mysqli_query($conn,$sql);

?>
