<?php
	$conn = mysqli_connect('localhost', 'root', '', 'ecd_db');

	if(!$conn){
		die('Could not connect'.mysqli_connect_error());
	}
?>