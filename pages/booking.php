<?php
	include("../include/header.php");
	include("../include/dbconnection.php");
	date_default_timezone_set("Asia/Bishkek");

	$email = $_SESSION['email'];
	$active_user = mysqli_query($db_connect, "select * from users where email='$email'");
	$active_userq = mysqli_fetch_array($active_user);
	$active_user_id = $active_userq['id'];

	$fieldId = mysqli_real_escape_string($db_connect, ($_GET['id']));
	$field_id = base64_decode($fieldId);
	$fieldquery = mysqli_query($db_connect, "select * from bookings where id = '$field_id' and booking_date = CURDATE() order by start_time");
	$fieldq_num = mysqli_num_rows($fieldquery);
	$field = mysqli_query($db_connect, "select * from football_fields where id = '$field_id'");
	$fieldq = mysqli_fetch_array($field);
	$name = $fieldq['name'];
	$mfield_id = $fieldq['id'];
	$field_id2 = base64_encode($field_id);
	$field_img = mysqli_query($db_connect, "select * from football_field_img where field_id = '$field_id'");

	if(isset($_POST['book'])){
		$start = mysqli_real_escape_string($db_connect, $_POST['start']);
		$end = mysqli_real_escape_string($db_connect, $_POST['end']);
		$id = mysqli_real_escape_string($db_connect, $_POST['id']);
		$booking_date = mysqli_real_escape_string($db_connect, $_POST['booking_date']);
		$fId = base64_encode($id);
		$curr_date = date("Y-m-d");
		$curr_time = strtotime(date("H:i:s"));
		$bookedOrNot = false;

		$time = mysqli_query($db_connect, "select * from bookings where id='$id' and start_time='$start' and end_time='$end' and booking_date = '$booking_date'");
		$check = mysqli_num_rows($time);
		//if($curr_date == $booking_date and strtotime($start_time) > strtotime(date("H:i:s", time()))){
			//die("No booking in the past!");
		//}
		
		//if($curr_date == $booking_date and $curr_time > $start){
		//	die("No booking in the past!");
		//}
		if($check>0){
			die("It is already book");
		}
		if($start > $end or ($end - $start > 1) or ($end - $start < 1))
		{
			//header("location:booking.php?msg=InvalidInput");
			die("Invalid Input");
		}
		if($booking_date < $curr_date){
			//header("location:booking.php?msg=NoPastBooking");
			die("You cannot book in the past");
		}
		else{
			$insert = mysqli_query($db_connect, "insert into bookings(id, start_time, end_time, user_id, booking_date) values('$id', '$start', '$end', '$active_user_id', '$booking_date')");
			if($insert){
				$bookedOrNot = true;
				header("location:booking.php?id=$fId;");
			}
			else{
				print "Booking was unsuccessfull!";
			}
		}
	}
	if(isset($_POST['cancel'])){
		$cancel = mysqli_real_escape_string($db_connect, $_POST['bookingId']);
		$id = mysqli_real_escape_string($db_connect, $_POST['id']);
		$delete_booking = mysqli_query($db_connect, "delete from bookings where booking_id='$cancel'");
		$fId = base64_encode($id);
		if($delete_booking){
			header("location:booking.php?id=$fId;");
		}
	}
	
	if(isset($_POST['like'])){
		$field_id = mysqli_real_escape_string($db_connect, $_POST['my_field_id']);
		$user_id = mysqli_real_escape_string($db_connect, $_POST['user_id']);
		$insert = mysqli_query($db_connect, "insert into fields_like(user_id, field_id) values('$user_id','$field_id')");
		$fId = base64_encode($field_id);
		if($insert){
			header("location:booking.php?id=$fId;");
		}
	}
?>

<html>
	<body>
		<h3 align="center"><?=$name;?></h3>
		<form action="booking.php" method="POST">
			<input type = "hidden" value = "<?=$field_id;?>" name="my_field_id">
			<input type="hidden" name="user_id" value="<?=$active_user_id;?>">
			<?
				$checkFields = mysqli_query($db_connect, "select * from fields_like where user_id='$active_user_id' and field_id ='$field_id'");
				$checkResult = mysqli_num_rows($checkFields);
				if($checkResult > 0){
					print "<center><input type='button' class='submit_btn' value = 'My Favorite Football Field'/></center>";
				}else{
					print "<center><input type = 'submit' class='submit_btn' value = 'Add to my Favorite Fields List' name='like'/></center>";
				}
			?>
			<?//print $field?>
			<label><?//=$all_likes;?></label>
		</form>
		
	<div style="margin-right:10%;margin-left:10%;">
		<P>Please note that below is the schedule of <strong><?=$name;?></strong> that is reserved for today. In addition, make sure that you can book only one hour between 09:00 to 21:00. Please keep in mind that you can cancel the booking at least two hours before the start time. To see the reviews and comments for this football field, click <a href="comments.php?field_id=<?=$field_id2;?>" class="submit_btn" style="height:10px;">here</a></P>

	<?php
		if($fieldq_num < 1){
			print "<p><strong>No booking has made yet</strong></p>";
		}
		else{
	?>
		<table><tr><td><strong>No</strong></td>
		<td style="width:80px;" align="center"><strong>From</strong></td>
		<td style="width:80px;" align="center"><strong>To</strong></td>
		<td style="width:180px;" align="center"><strong>Status</strong></td>
		<td align="center"><strong>Action</strong></td></tr>

<?php
			
		}
		$num = 1;
		while($fieldr = mysqli_fetch_array($fieldquery)){
			$start_time = $fieldr['start_time'];
			$end_time = $fieldr['end_time'];
			$user_id = $fieldr['user_id'];
			$booking_id = $fieldr['booking_id'];
			$current_time = date("H:i:s", time());

			print "<tr><td>".$num."</td>";
			print "<td style='width:80px;' align='center'>".$start_time."</td>";
			print "<td style='width:80px;' align='center'>".$end_time."</td>";
			$user = mysqli_query($db_connect, "select * from users where id = '$user_id'");
			$usersq = mysqli_fetch_array($user);
			$user_name = $usersq['user_name'];
			print "<td style='width:180px;' align='center'>Booked by ".$user_name."</td>";

			//print date("H:i:s", time());
			//print strtotime (date("H:i:s")) - strtotime ($start_time);
			if(($user_id == $active_user_id) and (strtotime($start_time) - strtotime(date("H:i:s", time())) > 7000)){
				print "<form method='post' action='booking.php'>";
					print "<input type='hidden' name='bookingId' value=".$booking_id.">";
					print "<input type='hidden' name='id' value=".$field_id.">";
					print "<td><input type='submit' class='submit_btn' name='cancel' align='center' value='Cancel Booking'></td></tr>";
				print "</form>";
			}
			else{
				print "<td><input type='button' class='submit_btn' value='Booked'></td></tr>";
			}
			$num++;
		}
	?>
		</table>

		<p>Please Choose Your Booking date and time:</p>

		<form method="post" action="booking.php">
			<label>Date</label>
			<input type="date" name="booking_date" required></br>
			<label>From</label>
			<input type="time" min="9:00" max="20:00" name="start" required>
			<label>To</lable>
			<input type="time" min="10:00" max="21:00" name="end" required>
			<input type="hidden" name="id" value="<?=$field_id;?>">
			<button name="book" class="submit_btn">Book</button>
		</form>

		<!--<p>To see the schedule for the Future days, choose the date:</p>
		<label>Date</label>
                        <input type="date" id="bookingDate">
			<button type="button" class="submit_btn" onclick="go()">Go</button>

			<div id="viewBooking"></div>-->
			<p>Images:</p>

		<?php
			while($field_imgr = mysqli_fetch_array($field_img)){
				$image = $field_imgr['image'];
				print "<div class='post-img'>";
				print "<img src='../images/footballFields/$image' style='height:200px;width:200px;'>";
				print "</div>";
			}
		?>

			<!--<script>
				function go(){
					var bookingDate = document.getElementById('bookingDate').value;
					<?php
						$data="<table><tr><td><strong>No</strong></td>"
                                                        ."<td><strong>From</strong></td>"
                                                        ."<td><strong>To</strong></td>"
                                                        ."<td><strong>Status</strong></td>"
                                                        ."<td><strong>Action</strong></td></tr>";

						$num = 1;
						$view_booking = mysqli_query($db_connect, "select * from bookings where booking_date=' +bookingDate+ '");
						while($booking_rows = mysqli_fetch_array($view_booking)){
							$start_time = $booking_rows['start_time'];
                	        			$end_time = $booking_rows['end_time'];
        	        		        	$user_id = $booking_rows['user_id'];
				                        $booking_id = $booking_rows['booking_id'];

							$data.="<tr><td>".$num."</td>"
	                			        ."<td>".$start_time."</td>"
		                		        ."<td>".$end_time."</td>";
	        	        		        $user = mysqli_query($db_connect, "select * from users where id = '$user_id'");
	                			        $usersq = mysqli_fetch_array($user);
	                			        $user_name = $usersq['user_name'];
	                			        $data.="<td>Booked by ".$user_name."</td>";
							$num++;
						}
						$data.="</table>";
					?>
                                	document.getElementById('viewBooking').innerHTML = '<?=$data;?>';
					//document.getElementById('viewBooking').innerHTML = bookingDate;
				}
			</script>-->

	</div>
	</body>
</html>
