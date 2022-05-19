<?php

//connects to database
 $connect = new PDO('mysql:host=localhost;dbname=HNDSOFT2SA3', 'HNDSOFT2SA3', 'Kp911JH34');
 
 if(isset($_POST["title"]))
 {
 $query = "INSERT INTO ecar_carbooking (title, primBookStart, primBookEnd) VALUES (:title, :primBookStart, :primBookEnd)";
 
  //prepares query to excecute
  $statement = $connect->prepare($query);
 
 //excecutes the prepared insert query to add data into //carbooking table and displays data on page
  $statement->execute(
  
	array(
	
		':title'			=> $_POST['title'],
		':primBookStart'	=> $_POST['start'],
		':primBookEnd'		=> $_POST['end']
	)
	);
  }
  ?>