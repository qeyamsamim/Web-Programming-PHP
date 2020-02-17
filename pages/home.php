<?php
	include("../include/dbconnection.php");
	include("../include/header.php");

?>

<!DOCTYPE html>
<html>
	<body>
		<form method="post" action="result.php" autocomplete="off">
			<div style="margin-right:20%;margin-left:20%;margin-top:2%;">
				<input type="text" name="input" placeholder="Search Football Fields, Sport Clubs..." style="width:80%;padding:5px;border:1px solid black">
				<button type="submit" class="submit_btn" name="search">Search</button>
			</div>
		</form>
		
		<div style="margin-left:10%;margin-right:10%;height:350px;">
		<table>
			<h2 align="center">Top 5 Football Fields</h2>
			<?php
			$i = 0;
			$fields = mysqli_query($db_connect, "select * from football_fields order by name");
			while($rows = mysqli_fetch_array($fields) and $i<5)
			{
				$name = $rows['name'];
				$fieldId = $rows['id'];
				$id = base64_encode($rows['id']);

				$field_img = mysqli_query($db_connect, "select * from football_field_img where field_id ='$fieldId'");
				$field_imgq = mysqli_fetch_array($field_img);
				$img = $field_imgq['image'];

				print "<a href='booking.php?id=<?=$id;?>'>";
				print "<div style='height:80%;width:18%;float:left;margin-left:10px;margin-top:5px;background:#4CAF50;'>";
				print "<img src='../images/footballFields/$img' class='field_img'>";
			 	print "<p align='center'style='color:white;font-size:20px;'><strong>$name</strong></p>";
				print "</div>";
				print "</a>";
				$i++;
			}
			?>
		</table>
		</div>
		<div style="margin-left:10%;margin-right:10%;height:350px;">
		<table>
                        <h2 align="center" style="margin-top:50px;">Top 5 Sport Clubs</h2>
			<?php
			$i = 0;
			$sp = mysqli_query($db_connect, "select * from sport_clubs order by name");
			while($rows = mysqli_fetch_array($sp) and $i < 5)
			{
				$name = $rows['name'];
				$club_id = $rows['id']; 
				$id = base64_encode($rows['id']);

				$club_img = mysqli_query($db_connect, "select * from sport_club_img where club_id ='$club_id'");
				$club_imgq = mysqli_fetch_array($club_img);
				$img = $club_imgq['image'];
				print "<a href='sportclubs.php?id=$id;'>";
                                print "<div style='height:80%;width:18%;float:left;margin-left:10px;margin-top:5px;background:#4CAF50;'>";
				print "<img src='../images/otherClubs/$img' class='field_img'>";
				print "<p align='center' style='color:white;font-size:20px;'><strong>$name</strong></p>";
				print "</div>";
				print "</a>";
				$i++;
			}
                        ?>
                </table>
		</div>
	</body>
</html>
