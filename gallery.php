<?php require 'admin/login/connection.php'; 
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$recordsPerPage = 12;
	$fromRecordNum = ($recordsPerPage * $page) - $recordsPerPage;
	$sql = "SELECT caption, image FROM gallery ORDER BY id desc LIMIT {$fromRecordNum}, {$recordsPerPage}"; 
	$row_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM gallery"));
	$row_count = ceil($row_count/$page);
	include "includes/header.php";
 ?>
	<div class="banner">
		<div class="container">
			<h1>Our Gallery</h1>
		</div>
	</div>
	<section class="gallery-section py-5">
		<div class="container">
			<div class="row">
			<?php 
				if ($result=mysqli_query($conn,$sql))
				  {
				  // Fetch one and one row
				  while ($row=mysqli_fetch_assoc($result))
				    {
		 	?>
				<div class="col-md-3 col-sm-6 mb-4">
					<a href="uploads/<?php echo $row['image']; ?>" data-lightbox="gallery" data-title="<?php $row['caption']; ?>" class="img_wrapper gallery-image"><img src="uploads/thumbs/<?php echo $row['image']; ?>" alt="<?php echo $row['caption']; ?>"></a>
				</div>
			<?php 
				    
				    }
				  // Free result set
				  mysqli_free_result($result);
				}
			 ?>	
				
			</div>
			<?php 
				$next = $row_count>$recordsPerPage ? true : false;
				$previous = $page == 1 ?  false :  true; 
				if(($page >= 1 && $next == 1) || $previous == 1){
			?>

			<div class="text-center">
				<?php 
					if($previous == 1){
						echo "<a href='?page=".($page-1)."' class='my-4 btn btn1 mr-2'>Previous</a>";
					} 
					if($next == 1){ 
						echo "<a href='?page=".($page+1)."' class='my-4 btn btn1'>Next</a>";
					}
				?>
			</div>
		<?php } ?>
		</div>
	</section>
<?php include "includes/footer.php"; ?>
