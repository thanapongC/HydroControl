
		<?php
		session_start();
			include("connect.php");

			$sql = "UPDATE tbl_user SET
			password = '".$_POST["password"]."',
			name = '".$_POST["name"]."'

			WHERE userid = '".$_POST["userid"]."'  ";


			$query = mysqli_query($conn,$sql);

			if ($query)
			{
				echo "Edite Success";
				header("location:../pages/index.php");
			}
			else
			{
				echo "Miss Recode";
			}
			mysqli_close($conn);
		 ?>
