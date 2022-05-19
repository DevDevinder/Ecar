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
			
			
			<!-- full call plugins -->
			<title>Calendar></title>
			 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  

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


			
			
			<h1 class="text-center display-4"> Booking Page</h1>

  
  <!-- activates fCal under this div tag-->
  <script>
  $(document).ready(function()
  {
	  var calendar = $('#calendar').fullCalendar(
	  {
		  editable:true,
		  
    eventStartEditable: false,
	eventEndEditable: false,
	  header:{
		  left:'prev,next today',
		  center:'title',
		  right:'month,agendaWeek,agendaDay'
		  
	  }, 
	  <!-- allows users to select dates/times-->
	  events:'load.php',
	  selectable:true,
	  selectHelper:true,
	  select:function(start,end,allDay)
	  
	  
	  { <!-- stores start and end times/dates in variables-->
		  var title = prompt("Please provide a title for this trip");

		  if(title)
		  {
			  var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
			  var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
			 
 <!-- insert sends data to this page and server-->
			 $.ajax({
				  url:"insert.php",
				  type:"POST",
				  data:{title:title, start:start, end:end},
				  success:function()
				  {
					  calendar.fullCalendar('refetchEvents');
				  alert("booking slot confirmed");
				  }
			 })
		  }
	  },
	/* <!--  <!-- allows event data to be edited-->
	  editable:true,
	
    eventStartEditable: false,

	  eventResize:function(event)
	  { <!-- stores start and end times/dates in variables-->
		  var start =$.fullCalendar.formatDate(event.start,"Y-MM-DD HH:mm:ss");
		  var end =$.fullCalendar.formatDate(event.end,"Y-MM-DD HH:mm:ss");
		  var title = event.title;
		  var id = event.id;
		  $.ajax({
			  url:"update.php",
			  type:"POST",
			  data:{title:title, start:start,end:end, id:id},
			  success:function(){
				  calendar.fullCalendar('refetchEvents');
				  alert("Event Updated");
			  }
		  })
	  },
	  
	 eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Updated");
      }
     });
    },
	
	eventClick:function(event)
	{
		if(confirm("click Ok to confirm removal"))
		{
			var id=event.id;
			$.ajax({
				url:"delete.php",
				type:"POST",
				data:{id:id},
				success:function()
				{
					calendar.fullCalendar('refetchEvents');
					
					alert("removed");
				}
			})
	}
	},
	-->>*/
	  
  });
  });
			</script>
			
			</head>
			<body>
			<br />
			<h2 align="center"><a href="#">Calendar<a/></h2>
			<br />
			<!-- loads full cal plugin -->
			<div class="container">
			<div id="calendar"></div>
			</div>
			</body>
			</html>
			










          

          <!-- Footer -->
          <br>
          <footer class="customFooter">
                <p class="text-center mb-0 py-2">Group 3 - Ryan Scott, Dev Bakshi, Katherine Carrillo and Filip Gajdamowicz</p>
          </footer>

          <!-- Include javascript plugins - required for most bootstrap components to function correctly -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        </body>
</html>