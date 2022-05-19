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

    # Check form submitted info from add car inputs.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        # Connect to the database.
        require('includes/connect_db.php');

        # Initialize an error array.
        $errors = array();

        #calls guid function, sets id to be a generated GUID
        $id = require("includes/guid.php");

        #setting status to empty
        $status = '';


        # Check for a plate:
        if (empty($_POST['plate'])) {
            $errors[] = 'no plate entered';
        } else {
            $plate = mysqli_real_escape_string($link, trim($_POST['plate']));
        }

        # Check if plate is already in use.
        if (empty($errors)) {
            $q = "SELECT carID FROM ecar_cars WHERE plate='$plate'";
            $r = @mysqli_query($link, $q);
            if (mysqli_num_rows($r) != 0) $errors[] = 'Registration plate already in database';
        }


        # Check for a make:
        if (empty($_POST['make'])) {
            $errors[] = 'no make entered';
        } else {
            $make = mysqli_real_escape_string($link, trim($_POST['make']));
        }


        # Check for a model:
        if (empty($_POST['model'])) {
            $errors[] = 'no model entered';
        } else {
            $model = mysqli_real_escape_string($link, trim($_POST['model']));
        }


        # Check for seats:
        if (empty($_POST['seats'])) {
            $errors[] = 'no seats entered';
        } else {
            $seats = mysqli_real_escape_string($link, trim($_POST['seats']));
        }





        # On success register user inserting into 'users' database table.
        if (empty($errors)) {
            $q = "INSERT INTO ecar_cars (carID, plate, make, model, seats, status) VALUES ('$id', '$plate', '$make', '$model', '$seats', '$status' )";
            $r = @mysqli_query($link, $q);
            if ($r) {
                echo '<h1>Added!</h1><p>Car added, please click <a href="admin_view_cars.php">here</a></p>';
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
        <h1 class="text-center display-4">Add Car</h1>
        <div class="col-sm d-flex justify-content-center">
            <div class="card text-center">

                <div class="card-body">
                    <!-- Display body section with sticky form. -->
                    <form action="admin_add_car.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="make" name="make" placeholder="Car Make" size="50" required value="<?php if (isset($_POST['make'])) echo $_POST['make']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="model" name="model" placeholder="Car Model" size="50" required value="<?php if (isset($_POST['model'])) echo $_POST['model']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" id="plate" name="plate" placeholder="Registration Plate (#### ####)" size="50" required value="<?php if (isset($_POST['plate'])) echo $_POST['plate']; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="number" class="form-control" id="seats" name="seats" placeholder="No. of seats (4)" size="50" required value="<?php if (isset($_POST['seats'])) echo $_POST['seats']; ?>">
                            </div>
                        </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="col-auto my-1">
                        <button type="submit" class="btn btn-dark btn-block">Add</button>
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