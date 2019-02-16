<?php 
$success = false;
require_once 'admin/login/connection.php'; 

if(isset($_POST['submit'])){
	if(isset($_POST['name']) && isset($_POST['contact']) && isset($_POST['address']) && isset($_POST['email']) && isset($_POST['description'])){
		$name=mysqli_escape_string($conn, $_POST['name']);
		$contact=mysqli_escape_string($conn, $_POST['contact']);
		$address=mysqli_escape_string($conn, $_POST['address']);
		$email=mysqli_escape_string($conn, $_POST['email']);
		$description=mysqli_escape_string($conn, $_POST['description']);
		$sql = "INSERT INTO enquiries (name, contact, address, email, description) VALUES ('$name', '$contact', '$address', '$email', '$description]')";

		if(mysqli_query($conn, $sql) == true){
			$success = true;
		}

		 
	}
}

?>


<?php include "includes/header.php"; ?>
<div class="banner">
	<div class="container">
		<h1>Contact Us</h1>
	</div>
</div>
	<div class="contact-section py-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mx-auto">
					<form class="form" method="post">
						<div class="form-row">
							<?php if($success): ?>
								<div class="alert alert-success form-group col-12 text-center">Thank you for contacting us. We will get back to you soon :)</div>
							<?php endif; ?>	
							<div class="form-group col-12">
								<label for="name">Name:</label>
								<input type="text" class="form-control" id="name" name="name" required>
							</div>
							<div class="form-group col-md-6">
								<label for="address">Address:</label>
								<input type="text" class="form-control" id="address" name="address" required>
							</div>
							<div class="form-group col-md-6">
								<label for="contact">Contact No:</label>
								<input type="number" class="form-control" id="contact" name="contact" required>
							</div>
							
							<div class="form-group col-12">
								<label for="email">Email address:</label>
								<input type="email" class="form-control" id="email" name="email" required>
							</div>
							<div class="form-group col-12">
								<label for="description">Description</label>
								<textarea class="form-control" id="description" name="description" rows="5" required></textarea>
							</div>
						</div>
						<button type="submit" name="submit" class="btn btn-outline-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php include "includes/footer.php"; ?>