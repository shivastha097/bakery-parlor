<?php 
  session_start();
  if(!isset($_SESSION) || empty($_SESSION['user_logged']) || !$_SESSION['user_logged']){
    header('location:index.php');
  }
  if(isset($_POST['caption']) && isset($_POST["submit"])){
    $caption = $_POST['caption'];
    $error = false;
    $success = false;
    // $target_dir = "uploads/";
    // $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $path_parts = pathinfo($_FILES["image"]["name"]);
    $target_file = "uploads/" . $path_parts['filename'].'_'.time().'.'.strtolower($path_parts['extension']);
    $image_name = $path_parts['filename'].'_'.time().'.jpg';
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image

      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check !== false) {
          // echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          $error = "File is not an image.";
          $uploadOk = 0;
      }
    // Check if file already exists
    // if (file_exists($target_file)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }
    // Check file size
    if ($_FILES["image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        include 'SimpleImage.php';
        try {
  // Create a new SimpleImage object
  $img = new SimpleImage();
  $img
    ->fromFile($_FILES["image"]["tmp_name"])                     // load image.jpg
    ->resize(1200)                        
    ->overlay('logo.png', 'bottom right')  // add a watermark image
    ->toFile('../../uploads/'.$image_name, 'image/jpeg', 80)
    ->resize(400)
    ->toFile('../../uploads/thumbs/'.$image_name, 'image/jpeg', 80);

    require_once 'connection.php';

    $sql = "INSERT INTO gallery (image, caption)
VALUES ('$image_name', '$caption')"; 

if ($conn->query($sql) === TRUE) {
    $success = true;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();   

} catch(Exception $err) {
  // Handle errors
  echo $err->getMessage();
}
        // if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //     $success = "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        //     echo $target_file;
        // } else {
        //     $error = "Sorry, there was an error uploading your file.";
        // }
    }

  }
 ?>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.php">
                            <i class="nc-icon nc-chart"></i>
                            <p>Gallery</p>
                        </a>
                    </li>
                    <li>
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
                                <a href="#" class="nav-link">
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
                                              <h4 class="card-title">Image Gallery
                                                <small>Add new image</small>
                                              </h4>
                                          </div>
                                          <div class="card-body">
                                              <div class="row">
                                                <div class="col-md-6">
                                                  <form method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                      <label>Caption</label>
                                                      <input type="text" class="form-control" name="caption" placeholder="Enter a caption for image..." required>
                                                    </div>
                                                    <div class="form-group">
                                                      <label>Upload Image</label>
                                                      <input type="file" name="image" class="form-control" placeholder="select image..." required>
                                                    </div>
                                                    <div class="form-group">
                                                      <button type="submit" name="submit" class="btn btn-success btn-block">Upload</button>
                                                    </div>
                                                  </form>
                                                </div>
                                              </div>
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
<script src="js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="js/demo.js"></script>

<?php 
  if($success){
    echo '
      <script>
            color = 2;

              $.notify({
                icon: "nc-icon nc-album-2",
                message: "Image Uploaded Successfully"

              },{
                type: type[color],
                timer: 3000,
                placement: {
                  from: "top",
                  align: "center"
                }
              });
          
          </script>
    ';
  }
 ?>

</html>