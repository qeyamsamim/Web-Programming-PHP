<?php
	include ("../include/header.php");	
	$user_email = $_SESSION['email'];
	$userquery = mysqli_query($db_connect, "select * from users where email='$user_email';");
	$userdetail = mysqli_fetch_array($userquery);
	$user_id = $userdetail['id'];

	/*if($_POST['like']) {
		$sql = "insert into fields_like (user_id, field_id) values ('$user_id', '$')";
		$result=$db_connect->query($sql);

	}*/
?>

<html>
	<body>
		<h3 align="center">Here you can book a Football Field</h3>
		<div class="contents">
		<table><tr><td><strong>No</strong></td>
		<td align="center"><strong>Name</strong></td>
		<td align="center"><strong>Address</strong></td>
		<td align="center"><strong>Contact</strong></td>
		<td align="center"><strong>Booking</strong></td>
		<tr>
		<?php
		$fields = mysqli_query($db_connect, "select * from football_fields order by name");
		$count = 1;
		while($rows = mysqli_fetch_array($fields)){
			$id = $rows['id'];
			$name = $rows['name'];
			$address = $rows['address'];
			$cont = $rows['contact_num'];
			$fieldId = base64_encode($id);

			print "<tr><td  align='center'>".$count."</td>";
			print "<td style='width:300px;' align='center'>".$name."</td>";
			print "<td style='width:250px;' align='center'>".$address."</td>";
			print "<td style='width:150px;' align='center'>".$cont."</td>";
			print "<td><a href='booking.php?id=<?=$fieldId;?>' class='submit_btn'>Book</a></td>";
			$count++;
		}
		print"</table>";
	?>
		</form>
		</div>
	</body>
</html>
