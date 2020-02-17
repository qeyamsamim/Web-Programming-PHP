<?php
	include("../include/header.php");
	include("../include/dbconnection.php");

	$post_id = mysqli_real_escape_string($db_connect, $_GET['post_id']);
	$postId = base64_decode($post_id);
?>
<html>
	<body>
		<?php
			$stuff_q = mysqli_query($db_connect, "select * from posts where post_id = '$postId'");
			$stuff_r = mysqli_fetch_array($stuff_q);
			$name = $stuff_r['name'];
			$description = $stuff_r['description'];
			$status = $stuff_r['status'];
			$price = $stuff_r['price'];
			$cont_num = $stuff_r['cont_num'];
			$city = $stuff_r['city'];
			$user_id = $stuff_r['user_id'];
			$post_date = $stuff_r['post_date'];

			$poster_nameq = mysqli_query($db_connect, "select * from users where id = '$user_id'");
			$poster_namer = mysqli_fetch_array($poster_nameq);
			$user_name = $poster_namer['user_name'];

			print "<div class='page_margin'>";
			print "<h3 align='center'>".$name."</h3>";
			print "<p><strong>Description:</strong></p>";
			print "<p>".$description."</p>";
			print "<p><strong>Status: </strong>".$status."</p>";
			print "<p><strong>Price: </strong>".$price."</p>";
			print "<p><strong>Contact Number: </strong>".$cont_num."</p>";
			print "<p><strong>City: </strong>".$city."</p>";
			print "<p><strong>Posted By: </strong>".$user_name."</p>";
			print "<p><strong>Posted on: </strong>".$post_date."</p>";
			print "<p><strong>Images:</strong></p>";

			$images = mysqli_query($db_connect, "select * from images where post_id  = '$postId'");
                        while($image_rows = mysqli_fetch_array($images)){
                                $image = $image_rows['image'];

				print "<div class='post-img'>";
				print "<img src='../images/sportStuff/$image'/ style='height:200px;width:200px;'>";
				print "</div>";
                        }
			print "</div>";
		?>
	</body>
</html>
