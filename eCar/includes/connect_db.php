<!-- Ryan Scott - EC1712474 -->
<!-- GRADED UNIT 2 -->

<!-- this page is used to allow the site to connect to the database, this is used by nearly all pages -->



<?php 
	//$dev_name='HNDSOFT2SA3';
	//$dev_password='Kp911JH34';
	//$dev_database='HNDSOFT2SA3';

	$link = mysqli_connect('localhost','HNDSOFT2SA3','Kp911JH34','HNDSOFT2SA3');
	if (!$link) { 
		die('Could not connect to MySQL: ' . mysqli_error()); 
	} 
?> 