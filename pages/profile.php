<?php
    include("../include/dbconnection.php");
	include("../include/header.php");
	date_default_timezone_set("Asia/Bishkek");

    $userquery = mysqli_query($db_connect, "select * from users where email='$email'");
    $userdetail = mysqli_fetch_array($userquery);
	$user_id = $userdetail['id'];
    $name = $userdetail['user_name'];
	$cont_num = $userdetail['contact_num'];

	if(isset($_POST['update'])) {
		$userId = mysqli_real_escape_string($db_connect, $_POST['user_id']);
		$date_time = date("Y-m-d H:i:s");
		$filename = $_FILES['img']['name'];
		$tmpname = $_FILES['img']['tmp_name'];
		$filesize = $_FILES['img']['size'];
		$fileerror = $_FILES['img']['error'];
		$filetype = $_FILES['img']['type'];

		$fileExt = explode('.', $filename);
		$fileActExt = strtolower(end($fileExt));
		$allowed = array('jpg', 'jpeg', 'png');

		if(in_array($fileActExt, $allowed)){
			if($fileerror === 0){
				if($filesize < 1000000){
					$fileNameNew = uniqid('', true).".".$fileActExt;
					$fileDst = '../images/profilePhotos/'.$fileNameNew;
					move_uploaded_file($tmpname, $fileDst);
					$insert = mysqli_query($db_connect, "insert into profile_photo(user_id, image, date_time) values('$userId', '$fileNameNew', '$date_time')");
					if($insert){
						header("Location:profile.php?success;");
					}
					else{
						header("location:profile.php?Failed;");
					}
				}else{
					print "Too Big!";
				}
			}else{
				print "Error while uploading";
			}
		}else{
			print "Invalid Type";
		}
	}

	if(isset($_POST['register'])) {
		$name = mysqli_real_escape_string($db_connect, $_POST['username']);
		$contact = mysqli_real_escape_string($db_connect, $_POST['contact']);
		$old_pwd = mysqli_real_escape_string($db_connect, $_POST['old_pwd']);
		$new_pwd1 = mysqli_real_escape_string($db_connect, $_POST['new_pwd1']);
		$new_pwd2 = mysqli_real_escape_string($db_connect, $_POST['new_pwd2']);
		$userId = mysqli_real_escape_string($db_connect, $_POST['user_id']);

		if(!empty($old_pwd) and !empty($new_pwd1) and !empty($new_pwd2)){
			$old_pwd2 = mysqli_query($db_connect, "select password from users where id = '$userId'");
			$old_pwdr = mysqli_fetch_array($old_pwd2);
			$pwd = $old_pwdr['password'];

			if($old_pwd == $pwd){
				if($new_pwd1 == $new_pwd2){
					$update = mysqli_query($db_connect, "update users set user_name = '$name', contact_num = '$contact', password = '$new_pwd1' where id = '$userId'");
					if($update){
						header("location:profile.php?Success");
					}
					else{
						header("location:profile.php?Failed");
					}
				}
				else{
					header("location:profile.php?PasswordsDoNotMatch!");
				}
			}
			else{
				header("location:profile.php?WrongPassword");
			}
		}
		else{
			$update = mysqli_query($db_connect, "update users set user_name = '$name', contact_num = '$contact' where id = '$userId'");
                        if($update){
                                header("location:profile.php?Success");
                        }
		}
	}
?>

<html>
	<head>
		<link rel="stylesheet" href="../css/mystyle.css"/>
	</head>
	<body>
		<div style="width:50%;float:left;">
		<div style="height:100px;width:100px;padding:1%;">
			<?php
				$profile = mysqli_query($db_connect, "select * from profile_photo where user_id = '$user_id' order by date_time desc");
				$profiler = mysqli_fetch_array($profile);
				$image = $profiler['image'];
				if(!empty($image)){
					print "<img src='../images/profilePhotos/$image' class='profile-img'/>";
				}else{
					print "<img src='../images/profilePhotos/default.png' class='profile-img'/>";
				}
				print "<h3 align='center'>".$name."</h3>";
			?>
		</div>
		</br>
		<form method="post" action="profile.php" enctype="multipart/form-data">
			<label>To Change Profile Photo, Click Here</label><br>
                        <input type="file" name="img"/>
			<input type="hidden" name="user_id" value="<?=$user_id;?>">
			<input type="submit" name="update" class="submit_btn" value="Change">
		</form>

		<p>To see your booking history click <a onclick="view()" style="color:blue">here</a></p>
		<table id="history_view"> </table>
		<p>To see your favourite football fields <a onclick="favList()" style="color:blue">here</a></p>
		<table id="fav_view"> </table>

			<script>
				function favList() {
					<?php
						$fav_fields = mysqli_query($db_connect, "select * from fields_like where user_id = '$user_id'");
						$mdata="<table><tr><td><strong>Name</strong></td>";
						while($mraw = mysqli_fetch_array($fav_fields)) {
							$mid = $mraw['field_id'];
							$field_raws = mysqli_query($db_connect, "select * from football_fields where id = '$mid'");
							$fields_q = mysqli_fetch_array($field_raws);
							$field_name = $fields_q['name'];
							$mdata.="<tr><td>".$field_name."</td></tr>";
						}
						$mdata.="</table>";
					?>
						document.getElementById('fav_view').innerHTML = '<?=$mdata;?>';
					}
			</script>
			<script>
						function view(){
					<?php
						$data="<table><tr><td><strong>No</strong></td>"
													."<td><strong>Name</strong></td>"
													."<td><strong>Date</strong></td>"
													."<td><strong>From</strong></td>"
													."<td><strong>To</strong></td></tr>";

						$num = 1;
						$booking_history = mysqli_query($db_connect, "select * from bookings where user_id = '$user_id' order by booking_date desc");
						while($rows = mysqli_fetch_array($booking_history)){
							$field_id = $rows['id'];
							$date = $rows['booking_date'];
							$start_time = $rows['start_time'];
							$end_time = $rows['end_time'];
							$field_nameq = mysqli_query($db_connect, "select * from football_fields where id = '$field_id'");
							$field_rows = mysqli_fetch_array($field_nameq);
							$field_name = $field_rows['name'];

							$data.="<tr><td>".$num."</td>"
								."<td>".$field_name."</td>"
								."<td>".$date."</td>"
								."<td>".$start_time."</td>"
								."<td>".$end_time."</td></tr>";
							$num++;
						}
						$data.="</table>";
					?>
					document.getElementById('history_view').innerHTML = '<?=$data;?>';
				}
			</script>
		</div>

		<div class="container_update">
			<h3 align="center">Edit Your Profile</h3>
			<form method="post" action="profile.php">
				<label>User Name</label>
				<input type="text" class="update_form" name="username" value="<?=$name;?>" required>
				<label>Email</label>
				<input type="email" class="update_form" name="email" readonly value="<?=$email;?>" required>
				<label>Contact Number</label>
				<input type="number" class="update_form" name="contact" value="<?=$cont_num;?>" required>
				<label>Old Password</label>
				<input type="password" class="update_form" name="old_pwd" placeholder="Type Old Password..">
				<label>New Password</label>
				<input type="password" class="update_form" name="new_pwd1" placeholder="Type New Password..">
				<label>Re-enter Password</label>
				<input type="password" class="update_form" name="new_pwd2" placeholder="Re-enter password..">
				<input type="hidden" name="user_id" value="<?=$user_id;?>">
				<input type="submit" name="register" class="submit_btn" style="margin-left:40%;" value="Save Changes">
			</form>
		</div>
	</body>
</html>
