<?php
	include_once("dbconnection.php");
	$select = "delete from bookings where booking_id='".$_GET['booking_id']."'";
	$query = mysqli_query($conn, $select) or die($select);
	header ("Location: booking.php");
?>
