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

    # Get all current info for user.            

    ?>


    <h1 class="text-center display-4">User ID - <?php echo $currentID; ?></h1>
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h4 class="text-center">Current Information</h4>
                <?php

                $q = "SELECT * FROM ecar_users WHERE userID='$currentID'";
                $r = mysqli_query($link, $q);
                if (mysqli_num_rows($r) > 0) {
                    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

                        $currentEmail = $row['email'];
                        $currentForename = $row['forename'];
                        $currentSurname = $row['surname'];
                        $currentBirthDate = $row['birthDate'];
                        $currentContactNumber = $row['contactNumber'];
                        $currentPassword = $row['password'];

                        echo '<hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">ID</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['userID'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['email'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Forename</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['forename'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Surname</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['surname'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">D.O.B</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['birthDate'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Contact Number</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['contactNumber'] . '</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary"><small>' . $row['password'] . '</small></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Admin Status</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">' . $row['isAdmin'] . '</div>
                </div>
                <hr>
                
                ';
                    }
                } ?>
            </div>
            <div class="col-sm-12 col-md-6">
                <h4 class="text-center">WARNING - PLEASE READ</h4>
                <hr>
                <p class="text-center text-secondary">Any changes made to the data can cause errors in the database, please make sure that the data matches up with the current data, and that the format is the same</p>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">

            </div>
            <div class="col-sm-12 col-md-6">

            </div>
        </div>
    </div>
    <br>
    <br>

    <?php
    # DISPLAY COMPLETE REGISTRATION PAGE.

    # Check form submitted.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        # Connect to the database.
        require('includes/connect_db.php');

        # Initialize an error array.
        $errors = array();

        #calls guid function
        $id = $currentID;

        # Check for an email address: 
        if (empty($_POST['email'])) {
            $errors[] = 'Error updating Email';
        } else {
            $email = mysqli_real_escape_string($link, trim($_POST['email']));
        }

        # Check for a first name.
        if (empty($_POST['forename'])) {
            $errors[] = 'Error updating Forename';
        } else {
            $forename = mysqli_real_escape_string($link, trim($_POST['forename']));
        }

        # Check for a last name.
        if (empty($_POST['surname'])) {
            $errors[] = 'Error updating Surname';
        } else {
            $surname = mysqli_real_escape_string($link, trim($_POST['surname']));
        }

        # Check for a date of birth.
        if (empty($_POST['birthDate'])) {
            $errors[] = 'Error updating Birth Date';
        } else {
            $dob = mysqli_real_escape_string($link, trim($_POST['birthDate']));
        }

        # Check for a phone number.
        if (empty($_POST['contactNumber'])) {
            $errors[] = 'Error updating Contact Number';
        } else {
            $phone = mysqli_real_escape_string($link, trim($_POST['contactNumber']));
        }


        # Check for a password and matching input passwords.
        if (empty($_POST['password'])) {
            $errors[] = 'Error updating Password';
        } else {
            $password = mysqli_real_escape_string($link, trim($_POST['password']));
        }



        if (empty($errors)) {
            $q = "UPDATE ecar_users SET userID='$id', email='$email', forename='$forename', surname='$surname', birthDate='$dob', contactNumber='$phone', password='$password' WHERE userID='$currentID'";
            $r = @mysqli_query($link, $q);
            if ($r) {
                echo '<h1 class="text-center">Success!</h1><br><p class="text-center">Please click <a href="admin_view_users.php">here</a> to update on site</p>';
            }

            # Close database connection.
            mysqli_close($link);

            exit();
        }
        # Or report errors.
        else {
            echo 'post didnt work';
            echo '<div class="container">
			<div class="alert alert-primary alert-dismissible fade show" role="alert">
			<h1>Error!</h1>
			<p id="err_msg">The following error(s) occurred:<br>';
            foreach ($errors as $msg) {
                echo " - $msg<br>";
            }
            echo '<hr>
			<p class="mb-0">Please try again.</p>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		   </div>
		  </div>';
            # Close database connection.
            mysqli_close($link);
        }
    }
    ?>




    <div class="container">
    <h4 class="text-center">Update User Information</h4>
    <div class="col-sm d-flex justify-content-center">
      <div class="card text-center">

        <div class="card-body">
          <!-- Display body section with sticky form. -->
          <form action="admin_edit_user.php?currentID=<?php echo $currentID ?>" method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="forename" name="forename" placeholder="First Name" value="<?php echo $currentForename ?>" size="20" required value="<?php if (isset($_POST['forename'])) echo $_POST['forename']; ?>">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="surname" name="surname" placeholder="Last Name" value="<?php echo $currentSurname ?>" size="20" required value="<?php if (isset($_POST['surname'])) echo $_POST['surname']; ?>">
              </div>
              <div class="form-group col-md-12">
                <input type="text" class="form-control" id="email" name="email" placeholder="example@example.com" value="<?php echo $currentEmail ?>" size="50" required value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="birthDate" name="birthDate" placeholder="2000-01-01" value="<?php echo $currentBirthDate ?>" size="20" required value="<?php if (isset($_POST['birthDate'])) echo $_POST['birthDate']; ?>">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="contactNumber" name="contactNumber" placeholder="phone number" value="<?php echo $currentContactNumber ?>" size="50" required value="<?php if (isset($_POST['contactNumber'])) echo $_POST['contactNumber']; ?>">
              </div>
              <div class="form-group col-md-12">
                <input type="text" class="form-control" id="password" name="password" placeholder="user password SHA2" value="<?php echo $currentPassword ?>" size="50" required value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
              </div>
            </div>
        </div>
        <div class="card-footer text-muted">
          <div class="col-auto my-1">
            <button type="submit" class="btn btn-dark btn-block">Update</button>
          </div>
          </form>

        </div>
      </div>
      </div>
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