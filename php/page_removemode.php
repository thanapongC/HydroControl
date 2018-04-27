
		<?php
		session_start();
			include("connect.php");

			$sql = "UPDATE tbl_user SET
			mode = '".$_POST["mode"]."'
			WHERE userid = '".$_POST["txtuserid"]."'";

			$query = mysqli_query($conn,$sql);

			if ($query)
			{
				echo "Edite Success !";
				header("location:../pages/mode.php");
			}
			else
			{
				echo "Miss Recode !!";
				//header("location:../pages/page_editeuser.php");

			}
			mysqli_close($conn);
		 ?>
