<?php
session_start();
unset ($_SESSION['ses_id']);
unset ($_SESSION['username']);
unset ($_SESSION['userid']);
unset ($_SESSION['status']);
session_destroy();
header('location:../index.php');
 ?>
