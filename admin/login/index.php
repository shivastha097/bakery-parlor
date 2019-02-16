<?php include "sessions.php"; ?>
<html>
	<head>
		<title>Dashboard</title>
		<style>
			body{
				background-color:brown;
				display:flex;
				justify-content:center;
			}
			.login-form{
				padding:30px;
				background-color:#fff;
				margin:auto;
				width:300px;
				box-shadow:0 0 20px 0 rgba(90,90,90,0.5);

			}
			.login-form .form-control{
				margin-bottom:15px;
				height:50px;
				padding:15px;
				display:block;
				width:100%;
			}
			.btn{
				display:block;
				width:100%;
				height:50px;
				text-align:center;
				border:none;
				background-color:brown;
				color:#fff;
				font-weight:bold;
			}
			.btn:hover{
				cursor:pointer;
			}
		</style>
	</head>
	<body>
		<form action="process.php" method="post" class="login-form">
			<?php if(isset($_GET['msg'])){
				echo "<div style='padding:15px; background-color:red;opacity:0.7;color:white;font-weight:bold;margin-bottom:20px'>".$_GET['msg']."</div>";
			} ?>
			<input type="email" name="email" class="form-control" placeholder="Enter Email Address" required>
			<input type="password" name="password" class="form-control" placeholder="Enter Password" required>
			<input type="submit" class="btn" value="Login">

		</form>
	</body>
</html>