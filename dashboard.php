
<?php 
    session_start(); 
		if(isset($_GET['logout'], $_GET['dashboard.php'])){ 
    header("location: login.php");
    session_unset();
		session_destroy();
		}
		if($_SESSION['logedin']){
	?>
<?php include "functions.php";?>
<?php require "db.php";?>
<?php
$user_id = 1;					
if(isset($_POST['submit'])){
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$desc = mysqli_real_escape_string($con, $_POST['desc']);
	$price = mysqli_real_escape_string($con, $_POST['price']);
	//book upload
	if(isset($_FILES['book']) && $_FILES['book']['name'] != ""){
				$fname = $_FILES["book"]["name"];
				$ftem_loc = $_FILES["book"]["tmp_name"];
						$fstore  = "books/".$fname;
						 move_uploaded_file($ftem_loc, $fstore);
	}
						 //image upload
			if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
				$file_name = $_FILES["image"]["name"];
				$file_tem_loc = $_FILES["image"]["tmp_name"];
						$urlCount = mysqli_query ($con, "SELECT `url` FROM bookrecord");
						$counterURL = mysqli_num_rows($urlCount);
						$counterURL++;
						$file_name = "u_".$user_id."_image".$counterURL;
						$file_store  = "img/".$file_name.".jpg";
						 move_uploaded_file($file_tem_loc, $file_store);
						$checkblank = array($name,$file_store, $fstore);
			$postStatus = checkEmpty($checkblank);
			if($postStatus){
				$insertdata = mysqli_query($con, "INSERT INTO bookrecord(id, title, description, url, price, status)
				VALUES ('', '$name', '$desc', '$fstore', '$price', '1')");
				
				if($insertdata){
			echo "<div class='alert alert-success' role='alert' 'alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							Record inserted succusfully
				  </div>";
	
		}
			else{
				echo "<div class='alert alert-danger' role='alert' 'alert-dismissible'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Kindly fill out form again</div>"; 
				}
		}
	}
}

$query = "SELECT * from Users where id='1'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" sizes="32x32" href="img/book.png">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
  <title>Online book store Admin Panel</title>

  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/mystyle.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></head>
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">
      
          <!-- Sidebar -->
          <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
              <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
              </div>
              <div class="sidebar-brand-text mx-3">Online Book Store<sup></sup></div>
            </a>
      
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
      
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
              <a class="nav-link" href="#">
				</li></a>
                <button class="btn-primary" onClick="myfunc();">Dashboard</button></a>
				
            <!-- Divider -->
            <hr class="sidebar-divider">
					<h6 class="text-white p-3"><?php echo $user['name'];  ?></h6>
			<hr class="sidebar-divider">
					<h6 class="text-white"><?php echo $user['email'];  ?></h6>
            <!-- Heading -->
            <div class="sidebar-heading">
        
            </div>
      
            <!-- Nav Item - Pages Collapse Menu -->
            <!-- Divider -->
            <hr class="sidebar-divider">
      
            <!-- Divider -->
    
          </ul>
          <!-- End of Sidebar -->
      
          <!-- Content Wrapper -->
          <div id="content-wrapper" class="d-flex flex-column">
      
            <!-- Main Content -->
            <div id="content">
      
              <!-- Topbar -->
			  
			  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hamza Yousuf</span>
                <img class="img-profile rounded-circle" src="img/hamza.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="https://localhost/project/login.php?logout='logout'" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
		
              <!-- End of Topbar -->
      
              <!-- Begin Page Content -->
              <div class="container-fluid">
      
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">
				Book Store Dashboard</h1>
    
              </div>
              <!-- /.container-fluid -->
      <div class="container-fluid">
	  <div id="myfunc"></div>
	  </div>
            </div>
            <!-- End of Main Content -->
      
            <!-- Footer -->
			<br>
			<br>
            <footer class="sticky-footer bg-white">
              <div class="container my-auto">
                <div class="copyright text-center my-auto foot">
                    <h6>
                  <span>Copyright © Online Book Store  2019</span></br>
                  <span>Hamza Yousuf</span><br>
                  <span>Portfolio Link --> <a href="https://sites.google.com/view/webhost112/">sites.google.com/view/webhost112/</a></span>
                </h6></div>
              </div>
            </footer>
            <!-- End of Footer -->
      
          </div>
          <!-- End of Content Wrapper -->      
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="http://localhost/project/login.php?logout='logout'">Logout</a>
              </div>
            </div>
          </div>
        </div>
      
        <!-- Bootstrap core JavaScript-->
        <script src="js/custom.js"></script>
        <script src="js/jquery.min.js"></script>
		
        <!-- Core plugin JavaScript-->
        <script src="jquery.easing.min.js"></script>
      
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
      </body>
</body>
</html>
<?php
      }
else{
  header('location: index.php');
}
?>
