<?php 
session_start();
if(!isset($_SESSION) || empty($_SESSION['user_logged']) || !$_SESSION['user_logged']){
	header('location:index.php');
}

if(isset($_GET['id'])){
	$id = $_GET['id'];
	require 'connection.php';

	$del_file = mysqli_query($conn, "select * from gallery where id='$id'"); 
	while($row = $del_file->fetch_assoc()) {
	$image = $row['image'];
	unlink("../../uploads/".$image);
	unlink("../../uploads/thumbs/".$image);
}
	$sql = 'DELETE from gallery WHERE id='.$id;

	if ($conn->query($sql) === TRUE) {

		header('location:dashboard.php?delete=success');
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();   
}
?>