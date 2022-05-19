<?php
//load.php
 // # Open database connection.
 // require ( 'includes/connect_db.php' ) ;
  
  $connect = new PDO('mysql:host=localhost;dbname=HNDSOFT2SA3', 'HNDSOFT2SA3', 'Kp911JH34');
  
  $data =array();
  
  $query ="SELECT * FROM ecar_carbooking ORDER BY primbookStart";
  
  //prepares query to excecute
  $statement = $connect->prepare($query);
 
 //excecutes the prepared statment
  $statement->execute();
  
  //fetches queery execution data 
  $result = $statement->fetchAll();
  
  //loop to fetch data from $result
  foreach($result as $row)
  {
	$data[] = array(
		'id'		=> 	$row["bookingID"],
		'title'		=> 	$row["title"],
		'start'		=>	$row["primBookStart"],
		'end'		=>	$row["primBookEnd"]
	);
  }
  echo json_encode($data);
  ?>