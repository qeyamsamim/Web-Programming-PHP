<?php
	if (($_SERVER['PHP_AUTH_USER'] != 'mnb') ||
       	($_SERVER['PHP_AUTH_PW'] != 'mnb1'))
        {
        header('WWW-Authenticate: Basic Realm="Secret Stash"');
        header('HTTP/1.0 401 Unauthorized');
        print('You must provide the proper credentials!');
        exit;
        }
	include("../include/dbconnection.php");

	if(isset($_POST['submit'])){
		$name = mysqli_real_escape_string($db_connect, $_POST['name']);
		$address = mysqli_real_escape_string($db_connect, $_POST['address']);
		$cont_num = mysqli_real_escape_string($db_connect, $_POST['cont_num']);
		$insert = mysqli_query($db_connect, "insert into football_fields(name, address, contact_num) values('$name', '$address', '$cont_num')");
		
		if($insert){
			//header("location:posting.php?Success;");die();
			$fieldId = mysqli_insert_id($db_connect);
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
												$fileDst = '../images/footballFields/'.$fileNameNew;
												$success = move_uploaded_file($tmpname, $fileDst);
												if($success){
													$insert_img = mysqli_query($db_connect, "insert into football_field_img(field_id, image) values('$fieldId', '$fileNameNew')");
													header("Location:posting.php?Success");
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
	if(isset($_POST['submit_clubs'])){
		$name = mysqli_real_escape_string($db_connect, $_POST['name']);
        $address = mysqli_real_escape_string($db_connect, $_POST['address']);
        $cont_num = mysqli_real_escape_string($db_connect, $_POST['cont_num']);
		$description = mysqli_real_escape_string($db_connect, $_POST['description']);

        $insert = mysqli_query($db_connect, "insert into sport_clubs(name, address, contact_num,description) values('$name', '$address', '$cont_num', '$description')");
		if($insert){
			$club_id = mysqli_insert_id($db_connect);
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
							$fileDst = '../images/otherClubs/'.$fileNameNew;
							$success = move_uploaded_file($tmpname, $fileDst);
							if($success){
								$insert_img = mysqli_query($db_connect, "insert into sport_club_img(club_id, image) values('$club_id', '$fileNameNew')");
								header("Location:posting.php?Success;");
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
	<body>
		<div style="width:20%;float:left;">
			<h2>Football Fields</h2>
			<form method="post" action="posting.php" enctype="multipart/form-data">
				<label>Name</label>
				<input type="text" name="name" style="width:100%;">
				<label>Address</label>
				<input type="text" name="address" style="width:100%;">
				<label>Contact Number</label>
				<input type="text" name="cont_num" style="width:100%;">
				<input type="file" name="img[]" multiple/>
				<input type="submit" value="Submit" name="submit">
            </form>
		</div>

		<div style="width:20%;float:left;margin-left:1%;">
		<h2>Other Sport Clubs</h2>
		<form method="post" action="posting.php" enctype="multipart/form-data">
                        <label>Name</label>
                        <input type="text" name="name" style="width:100%;">
						<label>Description</label>
						<textarea name="description" style="height:200px;width:100%;resize:none;"></textarea>
                        <label>Address</label>
                        <input type="text" name="address" style="width:100%;">
                        <label>Contact Number</label>
                        <input type="text" name="cont_num" style="width:100%;">
			<input type="file" name="img[]" multiple/>
                        <input type="submit" value="Submit" name="submit_clubs">
                </form>
		</div>
	</body>
</html>
