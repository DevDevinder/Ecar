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
            <a class="navbar-brand" href="index.php"><img class="logo" src="img/Logo.png" width="100"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>         
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="about_us.php">About us</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                  <ul class="navbar-nav mr-auto">
                      <li class="nav-item">
                          <a class="nav-link" href="login.php">Sign in</a>
                      </li>
                      <li class="nav-item active">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                  </ul>
              </form>
            </div>
          </nav>
          <!-- End of Navigation -->


  <?php # DISPLAY COMPLETE REGISTRATION PAGE.

  # Check form submitted.
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # Connect to the database.
    require('includes/connect_db.php');

    # Initialize an error array.
    $errors = array();

    #calls guid function
    $id = require("includes/guid.php");

    # Check for an email address:
    if (empty($_POST['email'])) {
      $errors[] = 'example@example.com';
    } else {
      $email = mysqli_real_escape_string($link, trim($_POST['email']));
    }

    # Check for a first name.
    if (empty($_POST['forename'])) {
      $errors[] = 'John';
    } else {
      $forename = mysqli_real_escape_string($link, trim($_POST['forename']));
    }

    # Check for a last name.
    if (empty($_POST['surname'])) {
      $errors[] = 'Handcock';
    } else {
      $surname = mysqli_real_escape_string($link, trim($_POST['surname']));
    }

    # Check for a date of birth.
    if (empty($_POST['birthDate'])) {
      $errors[] = '2000-04-11';
    } else {
      $dob = mysqli_real_escape_string($link, trim($_POST['birthDate']));
    }

    # Check for a phone number.
    if (empty($_POST['contactNumber'])) {
      $errors[] = '+441234567898';
    } else {
      $phone = mysqli_real_escape_string($link, trim($_POST['contactNumber']));
    }


    # Check for a password and matching input passwords.
    if (!empty($_POST['pass1'])) {
      if ($_POST['pass1'] != $_POST['pass2']) {
        $errors[] = 'Passwords do not match.';
      } else {
        $password = mysqli_real_escape_string($link, trim($_POST['pass1']));
      }
    } else {
      $errors[] = 'Enter your password.';
    }

    # Check if email address already registered.
    if (empty($errors)) {
      $q = "SELECT userID FROM ecar_users WHERE email='$email'";
      $r = @mysqli_query($link, $q);
      if (mysqli_num_rows($r) != 0) $errors[] = 'Email address already registered. <a href="login.php">Login</a>';
    }


    #setting isAdmin to 0 meaning no
    $isAdmin = 0;

    # On success register user inserting into 'users' database table.
    if (empty($errors)) {
      $q = "INSERT INTO ecar_users (userID, email, forename, surname, birthDate, contactNumber, password, isAdmin) VALUES ('$id', '$email', '$forename', '$surname', '$dob', '$phone', SHA2('$password',256), '$isAdmin' )";
      $r = @mysqli_query($link, $q);
      if ($r) {
        echo '<h1>Registered!</h1><p>You are now registered.</p><p><a href="login.php">Login</a></p>';
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
    <h1 class="text-center display-4">Sign Up</h1>
    <div class="col-sm d-flex justify-content-center">
      <div class="card text-center">

        <div class="card-body">
          <!-- Display body section with sticky form. -->
          <form action="register.php" method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="forename" name="forename" placeholder="First Name" size="20" required value="<?php if (isset($_POST['forename'])) echo $_POST['forename']; ?>">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="surname" name="surname" placeholder="Last Name" size="20" required value="<?php if (isset($_POST['surname'])) echo $_POST['surname']; ?>">
              </div>
              <div class="form-group col-md-12">
                <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" size="50" required value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
              </div>
              <div class="form-group col-md-6">
                <input type="test" class="form-control" id="birthDate" name="birthDate" placeholder="2000-01-01" size="20" required value="<?php if (isset($_POST['birthDate'])) echo $_POST['birthDate']; ?>">
              </div>
              <div class="form-group col-md-6">
                <input type="test" class="form-control" id="contactNumber" name="contactNumber" placeholder="phone number" size="50" required value="<?php if (isset($_POST['contactNumber'])) echo $_POST['contactNumber']; ?>">
              </div>
              <div class="form-group col-md-6">
                <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Create Password" size="20" required value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>">
              </div>
              <div class="form-group col-md-6">
                <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Confirm Password" size="20" required value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>">
              </div>
            </div>
        </div>
        <div class="card-footer text-muted">
          <div class="col-auto my-1">
            <button type="submit" class="btn btn-outline-success btn-block">Sign Up Now</button>
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