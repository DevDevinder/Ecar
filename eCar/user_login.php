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
                <li class="nav-item active">
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
                </li><li class="nav-item">
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

<h1 class="text-center display-4">User Area</h1>
<h2 class="text-center">
  </h1>



  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <h4 class="text-center">User Information</h4>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Email</h6>
          </div>
          <div class="col-sm-9 text-secondary"><?php echo "{$_SESSION['email']}" ?></div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Full Name</h6>
          </div>
          <div class="col-sm-9 text-secondary"><?php echo "{$_SESSION['forename']} {$_SESSION['surname']}" ?></div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">D.O.B</h6>
          </div>
          <div class="col-sm-9 text-secondary"><?php echo "{$_SESSION['birthDate']}" ?></div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Phone Number</h6>
          </div>
          <div class="col-sm-9 text-secondary"><?php echo "{$_SESSION['contactNumber']}" ?></div>
        </div>
        <hr>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="container">
          <h4 class="text-center">Change Password</h4>
          <hr>
          <h6>Characteristics of strong passwords: </h6>
          <ul>
            <li>At least 8 characters—the more characters, the better.</li>
            <li>A mixture of both uppercase and lowercase letters.</li>
            <li>A mixture of letters and numbers.</li>
            <li>Inclusion of at least one special character, e.g., ! @ # ? </li>
          </ul>
          <hr>
          <div class="d-grid gap-2 col-6 mx-auto">
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#password">Change Password</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-6">
      </div>
      <div class="col-sm-12 col-md-6">
      </div>
    </div>
    </div>
  </div>



  <!--  =============================
=====    Modal Change Password   =======
=================================== -->


  <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="password" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="change_password.php" method="post">
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Confirm Email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" required>

            </div>
            <div class="form-group">
              <input type="password" name="pass1" class="form-control" placeholder="New Password" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" required>

            </div>
            <div class="form-group">
              <input type="password" name="pass2" class="form-control" placeholder="Confirm New Password" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" required>

            </div>
            <div class="modal-footer">
              <div class="form-group">
                <input type="submit" name="btnChangePassword" class="btn btn-dark btn-block" value="Save Changes" />
              </div>
            </div>
          </form>
        </div>
      </div>
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