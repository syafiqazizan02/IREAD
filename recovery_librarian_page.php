<!DOCTYPE html>
<?php

	 include('db_conn.php');

   session_start();

  if (isset($_SESSION['username']))
  {
   $user = $_SESSION['username'];
  }
  else
  {
   header('location:./');
  }

    $stmt = $conn->prepare("SELECT * FROM librarian WHERE librarian_username=?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
     $librarian_favQues = $row ['librarian_favQues'];

?>

<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>I-READ</title>

  <link rel="shortcut icon" href="img/log.png">
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/freelancer.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">I-READ</a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="./">Home</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Header -->
  <header class="masthead ">
    <section id="contact">
      <div class="container">
      <h5 align="center">STEP 2: ANSWERED YOUR FAVOURITE QUESTION!</h5><br><br>
      <h5 align="center"><?php echo $librarian_favQues;?></h5><br>
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <form action="recovery_librarian_page.php" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label></label>
                  <input class="form-control" name="librarian_favAnsw" type="text" placeholder="Enter Favourite Answer" required>
                </div>
              </div><br>
              <div class="form-group">
                <center><button type="submit" class="btn btn-warning btn-xl" style="color:white;" name="recovery">Recovery&nbsp;&nbsp;<i class='fa fa-undo'></i></button>
                <input type="hidden"  name="username" value="<?php echo $user ;?>" >
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </header>

    <!-- Footer -->
    <footer class="footer text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Location</h4>
            <p class="lead mb-0">Jalan Alor Gajah Lama,
              <br>76100 Alor Gajah,
              <br>Melaka </p>
            </div>
            <div class="col-md-4 mb-5 mb-lg-0">
              <h4 class="text-uppercase mb-4">Around the Web</h4>
              <ul class="list-inline mb-0">
                <li class="list-inline-item">
                  <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.facebook.com/pages/category/School/Sekolah-kebangsaan-parit-melana-197739324018108/" target="blank">
                    <i class="fab fa-fw fa-facebook-f"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.instagram.com/explore/locations/577156856/sekolah-kebangsaan-parit-melana-durian-tunggal-melaka?hl=en" target="blank">
                    <i class="fab fa-fw fa-instagram"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="btn btn-outline-light btn-social text-center rounded-circle" href="http://skpm015.blogspot.com/" target="blank">
                    <i class="fab fa-fw fa-blogger"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.youtube.com/results?search_query=skpm" target="blank">
                    <i class="fab fa-fw fa-youtube"></i>
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-md-4">
              <h4 class="text-uppercase mb-4">I-READ</h4>
              <p class="lead mb-0">We aim to provide all the function needed to complete the library transaction.</p>
            </div>
          </div>
        </div>
      </footer>

      <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
      <div class="scroll-to-top d-lg-none position-fixed ">
        <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
          <i class="fa fa-chevron-up"></i>
        </a>
      </div>
			
      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- Plugin JavaScript -->
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

      <!-- Contact Form JavaScript -->
      <script src="js/jqBootstrapValidation.js"></script>
      <script src="js/contact_me.js"></script>

      <!-- Custom scripts for this template -->
      <script src="js/freelancer.min.js"></script>

    </body>

    </html>

<?php

    	include('db_conn.php');

    		if(isset($_POST['recovery']))
    		{
    			$librarian_favAnsw = $_POST['librarian_favAnsw'];

    			$stmt = $conn->prepare("SELECT *FROM librarian WHERE librarian_favAnsw=?");
    			$stmt->bind_param("s", $librarian_favAnsw);
    			$stmt->execute();

    			if($stmt->fetch())
    			{
    			     echo "<script>window.location.href='recovery_librarian_password.php';</script>";
    			}
    			else
    			{

    				echo "<script>alert('Sorry! Invalid Answer!')</script>";

    				session_start();
    				session_destroy();
    				echo "<script>window.location.href='recovery_username_page.php';</script>";
    				exit();
    			}
    		}

    ?>
