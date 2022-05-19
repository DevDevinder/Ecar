<?php
require('includes/connect_db.php');
session_start();

# Redirect if not logged in.
if (!isset($_SESSION['userID'])) {
  require('login_tools.php');
  load();
}

?>

<!doctype html>
    <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	
            <!-- My CSS -->
            <link rel="stylesheet" href="css/custom.css">

            <!-- title -->
            <title>eCar</title>

        </head>
        <body>
        <!-- Navbar -->
          <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #18454d;">
            <a class="navbar-brand" href="index_login.php"><img class="logo" src="img/Logo.png" width="100"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>         
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="user_login.php"><?php echo "{$_SESSION['forename']}" ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="user_booking.php">Bookings</a>
                </li>
                <?php
                if ($_SESSION['isAdmin'] == 1) {
                    echo '<li class="nav-item">
                  <a class="nav-link" href="admin_view_users.php">Edit Users</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="admin_view_cars.php">Edit Cars</a>
                </li>
				<li class="nav-item">
                  <a class="nav-link" href="booking_manger.php">Edit bookings</a>
                </li>';
                }
                ?>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                  <ul class="navbar-nav mr-auto">
                      <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                  </ul>
              </form>
            </div>
          </nav>
          <!-- End of Navigation -->



  <div class="container">
	<h1 class="text-center display-4">Cars</h1>
    <hr>
	
	<!--card 1 -->
	<div class="row ">

<?php
	 # Open database connection.
	require ( 'includes/connect_db.php' ) ;
	# Retrieve movies from 'movie' database table.
	$q = "SELECT * FROM ecar_cars";
	$r = mysqli_query( $link, $q ) ;
	if ( mysqli_num_rows( $r ) > 0 )
	{
	# Display body section.
 
	while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
	{
	echo '
	<div class="col-sm d-flex justify-content-center">
		<div class="card shadow p-3 mb-5 bg-light rounded" style="width: 18rem;">
		  <div class="card-body">
            <p class="text-dark">Car ID = '. $row['carID'].'</p>
            <hr>
            <p class="text-dark"><small>Registration Plate = '. $row['plate'].'</small></p>
            <p class="text-dark"><small>Make = '. $row['make'].'</small></p>
            <p class="text-dark"><small>Model = '. $row['model'].'</small></p>
            <p class="text-dark"><small>Seats = '. $row['seats'].'</small></p>
            <p class="text-dark"><small>Last checked by: '. $row['status'].'</small></p>';
            
    echo '
            <hr style="border-top: 1px solid #f8f9fa">
			<a href="admin_edit_car.php?currentID='.$row['carID'].'" class="btn btn-outline-success btn-block">Edit Car</a>
            <a href="admin_delete_car.php?currentID='.$row['carID'].'" class="btn btn-danger btn-block">Delete Car</a>
			
		  </div>
		</div>
	</div>	
	
		
	';

			 }
  
  
	# Close database connection.
	mysqli_close( $link) ; 
	}
	# Or display message.
	else { echo '<p>There are currently cars to display.</p>' ; }
			
	?>	

     <a href="admin_add_car.php" class="btn btn-success btn-block">Add New Car</a>
	</div>
  </div>



              <!-- Footer -->
              <br>
          <footer class="customFooter">
                <p class="text-center mb-0 py-2">Group 3 - Ryan Scott, Dev Bakshi, Katherine Carrillo and Filip Gajdamowicz</p>
          </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>