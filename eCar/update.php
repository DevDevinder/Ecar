<?php
//update.php
//make db connection
$connect = new PDO('mysql:host=localhost;dbname=HNDSOFT2SA3', 'HNDSOFT2SA3', 'Kp911JH34'); 


if(isset($_POST["id"]))
{
	$query = "UPDATE ecar_carbooking SET title=:title, primBookStart=:primBookStart, primBookEnd=:primBookEnd WHERE bookingID=:id";
	$statement = $connect->prepare($query);
	$statement->execute(
	array(
		':title'			=> $_POST['title'],
		':primBookStart'	=> $_POST['start'],
		':primBookEnd'		=> $_POST['end'],
		':id'			=> $_POST['id']
		)
		);
}
 

?>