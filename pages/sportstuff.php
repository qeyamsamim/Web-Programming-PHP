<?php
	include("../include/header.php");
	include("../include/dbconnection.php");
	$id=$_SESSION['id'];
	$email=$_SESSION['email'];

	if(isset($_POST['submit'])){
		$name = mysqli_real_escape_string($db_connect, $_POST['name']);
		$user_id = mysqli_real_escape_string($db_connect, $_POST['id']);
		$description = mysqli_real_escape_string($db_connect, $_POST['description']);
		$condition = mysqli_real_escape_string($db_connect, $_POST['condition']);
		$price = mysqli_real_escape_string($db_connect, $_POST['price']);
		$cont_num = mysqli_real_escape_string($db_connect, $_POST['cont_num']);
		$city = mysqli_real_escape_string($db_connect, $_POST['city']);
		$post_date = date("Y-m-d");

		$insert = mysqli_query($db_connect, "insert into posts(name, user_id, description, status, price, cont_num, city, post_date) values('$name', '$user_id', '$description', '$condition', '$price', '$cont_num', '$city', '$post_date')"); 
		if($insert){
			$post_id = mysqli_insert_id($db_connect);
			for($i=0; $i<count($_FILES['img']['name']); $i++){
				$filename = $_FILES['img']['name'][$i];
				$tmpname = $_FILES['img']['tmp_name'][$i];
				$filesize = $_FILES['img']['size'][$i];
				$fileerror = $_FILES['img']['error'][$i];
				$filetype = $_FILES['img']['type'][$i];

				$fileExt = explode('.', $filename);
				$fileActExt = strtolower(end($fileExt));
				$allowed = array('jpg', 'jpeg', 'png');

				if(in_array($fileActExt, $allowed)){
					if($fileerror === 0){
						if($filesize < 1000000){
							$fileNameNew = uniqid('', true).".".$fileActExt;
							$fileDst = '../images/sportStuff/'.$fileNameNew;
							$success = move_uploaded_file($tmpname, $fileDst);
							if($success){
							$insert = mysqli_query($db_connect, "insert into images(post_id, image) values('$post_id', '$fileNameNew')");
							header("Location:sportstuff.php?Success");
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
			//header("Location:sportstuff.php?Success"); die();
		}
	}
?>
<html>
	<link rel="stylesheet" href="../css/mystyle.css"/>
	<body>
		<div class="sportStuff">
			<h3 align="center">Here you can buy Sport Stuff</h3>

			<?php
				$things = mysqli_query($db_connect, "select * from posts order by post_date desc");
				while($rows = mysqli_fetch_array($things)){
					$post_id = $rows['post_id'];
					$name = $rows['name'];
					$postId = base64_encode($post_id);

					$imageq = mysqli_query($db_connect, "select * from images where post_id = '$post_id'");
					$img_rows = mysqli_fetch_array($imageq);
					$image = $img_rows['image'];
					if(!empty($image)){
						print "<div style='height:200px;width:20%;margin-top:10px;float:left;'>";
						print "<a href='sellingstuff.php?post_id=$postId;'>";
						print "<img src='../images/sportStuff/$image' class='sport_stuff'>";
						print "<h4 align='center'>".$name."</h4>";
						print "</a>";
						print "</div>";
					}
				}
			?>
		</div>
		<?php include("poststuff.php");?>
	</body>
</html>
