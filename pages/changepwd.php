<?php
session_start();
include("../include/dbconnection.php");
$mmail = $_SESSION['email'];
$userquery = mysqli_query($db_connect, "select * from users where email = '$mmail'");
$userdetail = mysqli_fetch_array($userquery);
$check_email = $userdetail['email'];
$user_name = $userdetail['user_name'];
$user_cont = $userdetail['contact_num'];

if(isset($_POST['change'])) {
	$n_pass1 = mysqli_real_escape_string($db_connect, $_POST['pass1']);
	$n_pass2 = mysqli_real_escape_string($db_connect, $_POST['pass2']);
	$n_user_name = mysqli_real_escape_string($db_connect, $_POST['username']);
	$n_email = mysqli_real_escape_string($db_connect, $_POST['nm_email']);
	$n_cont_num = mysqli_real_escape_string($db_connect, $_POST['n_cont_num']);
	if($n_pass1 != $n_pass2) {
		die("Password does not match!");
	} else {
		$insert = mysqli_query($db_connect, "update users set password = '$n_pass1', user_name = '$n_user_name', email = '$n_email', contact_num = '$n_cont_num' where user_name = '$user_name';");
	}

}
?>

<html>
	<link rel="stylesheet" href="../css/mystyle.css"/>
	<body>
		<h3 align="center" style="margin-top: 2%">Please Sign Up to Continue</h3>
		<div class="container">
		<form method="post" action="changepwd.php">
			<label>User Name</label>
			<br><br>
			<input class="inputForm" name="username" placeholder=<?=$user_name?>></input>
			<br><br>
			<input class="inputForm" name="nm_email" placeholder=<?=$check_email?>></input>		
			
		
			<br><br>

			<label>Contact Number</label>
			<input class="inputForm" name="n_cont_num" placeholder=<?=$user_cont?>></input>
			<br><br>

			<label>Password</label>
			<input type="password" class="inputForm" name="pass1" placeholder="Type Password.." required>
			<label>Re-enter Password</label>
			<input type="password" class="inputForm" name="pass2" placeholder="Re-enter password.." required>

			<button name="change">Change</button>
		</form>
		</div>
	</body>
</html>
