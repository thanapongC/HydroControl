
		<?php
		session_start();
			include("connect.php");

			$sql = "UPDATE tbl_user SET
			name = '".$_POST["name"]."',
			password = '".$_POST["password"]."'
			WHERE userid = '".$_POST["userid"]."'";

			$query = mysqli_query($conn,$sql);

			if ($query)
			{
				echo "Edite Success !";
				header("location:../pages/index.php");
			}
			else
			{
				echo "Miss Recode !!";
				//header("location:../pages/page_editeuser.php");

			}
			mysqli_close($conn);
		 ?>
