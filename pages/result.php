<?php
	include("../include/dbconnection.php");
	include("../include/header.php");

?>

<!DOCTYPE html>
<html>
	<body>
		<form method="post" action="result.php"  autocomplete="off">
			<div style="margin-right:20%;margin-left:20%;margin-top:2%;">
				<input type="text" name="input" placeholder="Search Football Fields, Sport Clubs..." style="width:80%;padding:5px;border:1px solid black">
				<button type="submit" class="submit_btn" name="search">Search</button>
			</div>
		</form>
		<?
			if(isset($_POST['search'])){
				$input = mysqli_real_escape_string($db_connect, $_POST['input']);

				$fields = mysqli_query($db_connect, "select * from football_fields where name Like '%$input%' order by name");
				$fieldsn = mysqli_num_rows($fields);
				
				if($fieldsn > 0){
					print "<h3 align='center'>Football Fields</h3>";
					print "<table style='margin-left:40%;'><tr><td><strong>No</strong></td>";
					print "<td><strong>Name</strong></td></tr>";

					$num = 1;
					while($rows = mysqli_fetch_array($fields)){
						$name = $rows['name'];
						$id = $rows['id'];
						$fieldId = base64_encode($id);

						print "<tr><td>".$num."</td>";
						print "<td><a href='booking.php?id=<?=$fieldId;'>".$name."</a></td></tr>";

						$num++;
					}
					print "</table>";
				}
				
				$clubs = mysqli_query($db_connect, "select * from sport_clubs where name Like '%$input%' order by name");
				$clubsn = mysqli_num_rows($clubs);
				
				if($clubsn > 0){
					print "<h3 align='center'>Other Sport Clubs</h3>";
					print "<table style='margin-left:40%;'><tr><td><strong>No</strong></td>";
					print "<td><strong>Name</strong></td></tr>";

					$num = 1;
					while($rows = mysqli_fetch_array($clubs)){
						$name = $rows['name'];
						$id = $rows['id'];
						$fieldId = base64_encode($id);

						print "<tr><td>".$num."</td>";
						print "<td><a href='sportclubs.php?id=<?=$fieldId;'>".$name."</a></td></tr>";

						$num++;
					}
					print "</table>";
				}
				if($fieldsn==0 and $clubsn==0){
					print "<h3 align='center'>No Results Found!</h3>";
				}
			}
		?>
	</body>
</html>