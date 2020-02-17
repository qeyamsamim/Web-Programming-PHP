<?php
        include ("../include/header.php");
	$id = mysqli_real_escape_string($db_connect, $_GET['id']);
        $club_id = base64_decode($id);

	$clubs = mysqli_query($db_connect, "select * from sport_clubs where id = '$club_id'");
	$clubsr = mysqli_fetch_array($clubs);
	$name = $clubsr['name'];
	$description = $clubsr['description'];
	$address = $clubsr['address'];
	$cont_num = $clubsr['contact_num'];

	$image = mysqli_query($db_connect, "select * from sport_club_img where club_id = '$club_id'");
?>


<!DOCTYPE html>
<html>
        <body>
		<div class="page_margin">
		<h2 align="center"><?=$name;?></h2>

		<p><strong>Description:</strong></p>
		<p><?=$description;?></p>
		<p><strong>Address: </strong><?=$address;?></p>
		<p><strong>Contact Number: </strong><?=$cont_num;?></p>
		<p><strong>Images: </strong></p>
		<?php
			while($image_q = mysqli_fetch_array($image)){
				$img = $image_q['image'];
				print "<div class='post-img'>";
					print "<img src='../images/otherClubs/$img' style='height:200px;width:200px;'>";
				print "</div>";
			}
		?>
		</div>
	</body>
</html>
