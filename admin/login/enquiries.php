<?php 
session_start();
if(!isset($_SESSION) || empty($_SESSION['user_logged']) || !$_SESSION['user_logged']){
  header('location:index.php');
}
?>
<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
  <link rel="icon" type="image/png" href="img/favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Dashboard</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
  <!-- CSS Files -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/light-bootstrap-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="css/demo.css" rel="stylesheet" />
</head>

<body>
  <div class="wrapper">
    <div class="sidebar" data-color="red" data-image="img/sidebar-5.jpg">
      <div class="sidebar-wrapper">
        <div class="logo">
          <a href="#" class="simple-text">
            Kiran
          </a>
        </div>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="nc-icon nc-chart"></i>
              <p>Gallery</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="enquiries.php">
              <i class="nc-icon nc-album-2"></i>
              <p>Enquiries</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg " color-on-scroll="500">
        <div class=" container-fluid  ">
          <a class="navbar-brand" href="dashboard.php"> Dashboard </a>
          <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="nav navbar-nav mr-auto">
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link">
                  <i class="nc-icon nc-palette"></i>
                  <span class="d-lg-none">Dashboard</span>
                </a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="logout.php">
                  <span class="no-icon">Log out</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header ">
                  <h4 class="card-title">Enquiries</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                  <table class="table table-hover table-striped">
                    <thead>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Contact</th>
                      <th>Email</th>
                      <th>Actions</th>
                    </thead>
                    <tbody>
                      <?php 
                      $sql = "SELECT * FROM enquiries"; 
                      if ($result=mysqli_query($conn,$sql))
                      {
                        $i = 0;
                        while ($row=mysqli_fetch_array($result))
                        {
                          ?>
                          <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><a href="?read=<?php echo $row['id']; ?>" class="btn btn-success mr-2">Read</a></td>

                          </tr>
                          <?php 

                        }
                          // Free result set
                        mysqli_free_result($result);
                      }
                      ?> 

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<!--   Core JS Files   -->
<script src="js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="js/core/popper.min.js" type="text/javascript"></script>
<script src="js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="js/plugins/bootstrap-switch.js"></script>
<script src="js/plugins/bootstrap-notify.js"></script>
<script src="js/demo.js"></script>
<script src="js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<!-- <script src="../js/demo.js"></script> -->

<?php 
if (isset($_GET['read'])){
  $read_id = $_GET['read'];

  if($msg_result = mysqli_query($conn, "SELECT * FROM enquiries WHERE id='$read_id'")){
    while($msg_row = mysqli_fetch_assoc($msg_result)){
      $msg = $msg_row['description'];
    }
  }
  ?>
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Message</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <?php echo $msg; ?>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  <script type="text/javascript">
      $(window).on('load',function(){
          $('#myModal').modal('show');
      });
  </script>
<?php } ?>
</html>