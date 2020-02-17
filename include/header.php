<?php
	session_start();
	if(empty($_SESSION['email'])){
		header("Location:../index.php"); die();
	}
	include("dbconnection.php");
	$email = $_SESSION['email'];
	$userquery = mysqli_query($db_connect, "select * from users where email='$email'");
	$userdetail = mysqli_fetch_array($userquery);
	$name = $userdetail['user_name'];
	$user_id = $userdetail['id'];
	$profile = mysqli_query($db_connect, "select * from profile_photo where user_id = '$user_id' order by date_time desc");
	$profiler = mysqli_fetch_array($profile);
	$image = $profiler['image'];
	
?>
<header>
	<link rel="stylesheet" href="../css/mystyle.css" />
	<div class="navbar" id="myTopnav">
		<a href="home.php">HOME</a>
		<a href="fields.php">FOOTBALL FIELDS</a>
		<a href="clubs.php">SPORT CLUBS</a>
		<a href="sportstuff.php">SPORT STUFF</a>
		<a href="contact.php">CONTACT</a>
		<a href="about.php">ABOUT</a>
		<a href="../pages/logout.php" class="login">Logout</a>
		<a href="../pages/profile.php" class="login"><?=$name;?></a>
		<?
			if(!empty($image)){
				print "<img src='../images/profilePhotos/$image' class='login header-img'/>";
			}else{
				print "<img src='../images/profilePhotos/default.png' class='login header-img'/>";
			}
		?>
	</div>
</header>
<html>
	<head>
		<title>Sport KG</title>
	</head>
</html>