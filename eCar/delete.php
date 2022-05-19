<?php
//delete.php
//deletes events from calendar and db

if(isset($_POST["id"]))
{
 $connect = new PDO('mysql:host=localhost;dbname=HNDSOFT2SA3', 'HNDSOFT2SA3', 'Kp911JH34');
 
 $query = "
 DELETE from ecar_carbooking Where bookingID=:id";
 $statement = $connect ->prepare($query);
 $statement->execute(
 array(
 ':id' => $_POST['id']
 )
 );
 }
 ?>