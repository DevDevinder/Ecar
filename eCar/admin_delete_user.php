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


    <?php
    if (isset($_GET['currentID'])) $currentID = $_GET['currentID'];

    $q = "DELETE FROM ecar_users WHERE userID='$currentID'";
    $r = @mysqli_query($link, $q);
    ?>

    <p>user has been deleted, please click <a href="admin_view_users.php">here</a> to update on site</p>



        </div><!-- end of container-->


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