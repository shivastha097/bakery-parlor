<?php 
	session_start();
	if(isset($_SESSION) && !empty($_SESSION['user_logged']) && $_SESSION['user_logged']){
		header('location:dashboard.php');
	}
 ?>