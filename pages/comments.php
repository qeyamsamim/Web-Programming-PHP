<?php
	include("../include/header.php");

	$email = $_SESSION['email'];
        $active_user = mysqli_query($db_connect, "select * from users where email='$email'");
        $active_userq = mysqli_fetch_array($active_user);
        $active_user_id = $active_userq['id'];

	$field_id = mysqli_real_escape_string($db_connect, $_GET['field_id']);
	$fieldId = base64_decode($field_id);
	$field = mysqli_query($db_connect, "select * from football_fields where id = '$fieldId'");
	$fieldq = mysqli_fetch_array($field);
	$field_name = $fieldq['name'];
	$date = date("Y-m-d");
	$time = date("H:i:s");

	if(isset($_POST['comment'])){
		$comment = mysqli_real_escape_string($db_connect, $_POST['comments']);
		$field = mysqli_real_escape_string($db_connect, $_POST['id']);
		$f_id = base64_encode($field);

		$comment_insert = mysqli_query($db_connect, "insert into comments(field_id, user_id, comment, date, time) values('$field', '$active_user_id', '$comment', '$date', '$time')");
		if($comment_insert){
			header("location:comments.php?field_id=$f_id");
		}

	}
	if(isset($_POST['delete_cmnt'])){
		$comment_id = mysqli_real_escape_string($db_connect, $_POST['cmnt_id']);
		$field = mysqli_real_escape_string($db_connect, $_POST['id']);
                $f_id = base64_encode($field);

		$cmnt_delete = mysqli_query($db_connect, "delete from comments where id = '$comment_id'");
		if($cmnt_delete){
                        header("location:comments.php?field_id=$f_id");
                }
	}
?>

<html>
	<link rel="stylesheet" href="../css/mystyle.css"/>
	<body>
		<h3 align="center"><?=$field_name?></h3>

		<div style="margin-left:30%;margin-right:30%;">
			<form action="comments.php" method="post">
				<p>You can leave a comment about this football field here:</p>
				<textarea name="comments" class="cmntBox" style="width:80%;resize:none;"></textarea>
				<input type="submit" name="comment" class='submit_btn' value="Submit">
				<input type="hidden" name="id" value="<?=$fieldId;?>">
			</form>
		</div>
			<?php
				$comments = mysqli_query($db_connect, "select * from comments where field_id = '$fieldId' order by date desc");
				while($rows = mysqli_fetch_array($comments)){
					$cmnt_id = $rows['id'];
					$cmnt = $rows['comment'];
					$user_id = $rows['user_id'];
					$cmnt_date = $rows['date'];
					$cmnt_time = $rows['time'];
					$user_name = mysqli_query($db_connect, "select * from users where id = '$user_id'");
					$nameq = mysqli_fetch_array($user_name);
					$name = $nameq['user_name'];
					$user_photo = mysqli_query($db_connect, "select * from profile_photo where user_id = '$user_id'");
					$user_photoq = mysqli_fetch_array($user_photo);
					$photo = $user_photoq['image'];
					
					print "<div class='commentBox'>";
					if(!empty($photo)){
						print "<img src='../images/profilePhotos/$photo' class='comment_photo'>";
					}else{
						print "<img src='../images/profilePhotos/default.png' class='comment_photo'>";
					}
					print "<p style='margin-left:1%;'><strong>".$name.": </strong>".$cmnt."</p>";
					print "<p style='margin-left:90%;font-size:12px;'>".$cmnt_date."</p>";
					print "</div>";
					if($user_id == $active_user_id){
						print "<form method='post' action='comments.php'>";
						print "<input type='hidden' name='cmnt_id' value=".$cmnt_id.">";
						print "<input type='hidden' name='id' value=".$fieldId.">";
						print "<input type='submit' name='delete_cmnt' class='submit_btn' value='Delete' style='margin-left:77%;margin-bottom:-10px;'>";
						print "</form>";
					}
				}
			?>
	</body>

</html>
