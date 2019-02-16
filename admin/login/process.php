<?php include "sessions.php" ?>
<?php
	if(isset($_POST['email']) && isset($_POST['password'])){
		$user_email = $_POST['email'];
		$user_pass = $_POST['password'];
		
		include "connection.php"; 

		$sql = "SELECT email, password FROM kiran_user_admin";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		   $row = $result->fetch_array();

		   if($user_email == $row['email'] && md5($user_pass) == $row['password']){
		   		$_SESSION['user_logged'] = true;
		   		header('location:dashboard.php');
		   }
		   else{
		   	$wrong_credentials = "Wrong Creadentials...";
		   	header('location:index.php?msg='.urlencode($wrong_credentials));
		   }
		}
		$conn->close();
	}else{
		header('Location:index.php');
	}
 ?>