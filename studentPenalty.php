<!DOCTYPE html>

<?php


  include "dbconnect.php";
  include "sessioncheck.php";

  $username = $_SESSION['username'];

  $pickname = "SELECT member_fullname, member_id FROM member WHERE member_ic='$username'";
  $displayname = mysqli_query($db, $pickname);

  foreach ($displayname as $key)
  {

	$boo = "SELECT book.book_tittle, borrow.borrow_date, borrow.due_date, returnss.penalty_day, returnss.penalty_amount, done.done_date  FROM returnss INNER JOIN book ON returnss.book_id = book.book_id INNER JOIN done ON returnss.done_id = done.done_id INNER JOIN borrow ON returnss.borrow_id = borrow.borrow_id
            WHERE borrow.member_id = '".$key['member_id']."'" ;
	$book = mysqli_query($db, $boo);

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

    <!-- Custom styles for data table -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Penalty</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3" href="profile.php"><?php echo $key['member_fullname']; ?></a>
            <?php } ?>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="studentMainPage.php">Home</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    <!-- Header -->
    <header class="masthead ">

    <section id="contact">
        <div class="container">

          <div id="right-panel" class="right-panel">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                  <strong class="card-title">Penalty</strong>
                </div>

                <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                          <th>Book Title</th>
                  				<th>Borrowed Date</th>
                  				<th>Due date</th>
                          <th>Return date</th>
                          <th>Day Late</th>
                          <th>Penalty Amount (RM)</th>
                        </tr>
                    </thead>


        <tbody>
			<?php
			foreach ($book as $key) {
        $borrowtime = explode(" ",$key['borrow_date']);
        $btime = $borrowtime[1];
        $bdate = $borrowtime[0];

        $duetime = explode(" ",$key['due_date']);
        $dtime = $duetime[1];
        $ddate = $duetime[0];

        $donetime = explode(" ",$key['done_date']);
        $dontime = $donetime[1];
        $dondate = $donetime[0];

        $booktitle = $key['book_tittle'];
        $daylate = $key['penalty_day'];
        $penaltyamount = $key['penalty_amount'];



			?>

			<tr>
        <td><?php echo $booktitle ?></td>
				<td><?php echo $bdate; ?></td>
				<td><?php echo $ddate ?></td>
        <td><?php echo $dondate ?></td>
        <td><?php echo $daylate ?></td>
        <td><?php
       if ( $penaltyamount <=9)
        {
          $totalpay = $penaltyamount/10;
          echo "0.$penaltyamount"; echo "0";
        }
        else {
          $totalpay = 0.0 + ($penaltyamount/10);
          echo "$totalpay"; echo ".0";
        }
        ?></td>


			</tr>


      <?php }	?>
      </tbody>
  	</table>

  </div>
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

    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; Your Website 2018</small>
      </div>
    </div>

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

    <!-- Custom scripts for data table -->
    <script src="js/data-table/datatables.min.js"></script>
    <script src="js/data-table/dataTables.bootstrap.min.js"></script>
    <script src="js/data-table/dataTables.buttons.min.js"></script>
    <script src="js/data-table/buttons.bootstrap.min.js"></script>
    <script src="js/data-table/jszip.min.js"></script>
    <script src="js/data-table/pdfmake.min.js"></script>
    <script src="js/data-table/vfs_fonts.js"></script>
    <script src="js/data-table/buttons.html5.min.js"></script>
    <script src="js/data-table/buttons.print.min.js"></script>
    <script src="js/data-table/buttons.colVis.min.js"></script>
    <script src="js/data-table/datatables-init.js"></script>



      <script>
        $(document).ready(function() {
          $('#bootstrap-data-table').DataTable();
        } );
      </script>

  </body>

</html>
