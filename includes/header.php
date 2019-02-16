<!DOCTYPE html>
<html lang="en">
<head>
	<title>Kiran Cake Parlour</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="img/favico.png" type="x-imge/icon">
	<link rel="stylesheet" href="css/font/flaticon.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg custom-nav">
		<div class="container">
			<a class="navbar-brand" href="index"><img src="img/logo.png" alt="" height="100px"></a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navb">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item <?php echo $_SERVER['SCRIPT_NAME'] == '/index.php'? 'active' : ''; ?>">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item <?php echo $_SERVER['SCRIPT_NAME'] == '/about.php'? 'active' : ''; ?>">
						<a class="nav-link" href="about.php">About</a>
					</li>
					<li class="nav-item <?php echo $_SERVER['SCRIPT_NAME'] == '/services.php'? 'active' : ''; ?>">
						<a class="nav-link" href="services.php">Products &amp; Services</a>
					</li>
					<li class="nav-item <?php echo $_SERVER['SCRIPT_NAME'] == '/gallery.php'? 'active' : ''; ?>">
						<a class="nav-link" href="gallery.php">Gallery</a>
					</li>
					<li class="nav-item <?php echo $_SERVER['SCRIPT_NAME'] == '/contact.php'? 'active' : ''; ?>">
						<a class="nav-link" href="contact.php">Contact Us</a>
					</li>
				</ul>
			</div>	    		
		</div>
	</nav>