<?php
	$host_name = 'localhost';
	$user_name = 'root';
	$password = '';
	$db_name = 'sportkg';


	$db_connect = mysqli_connect($host_name, $user_name, $password, $db_name)
	or die("Not Connected");

	date_default_timezone_set('Asia/Bishkek');
?>
