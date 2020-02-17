<?php
session_start();
include("../include/dbconnection.php");

	if(isset($_POST['register'])){
		$username = mysqli_real_escape_string($db_connect, $_POST['username']);
		$email = mysqli_real_escape_string($db_connect, $_POST['email']);
		$pass1 = mysqli_real_escape_string($db_connect, $_POST['pass1']);
		$pass2 = mysqli_real_escape_string($db_connect, $_POST['pass2']);
		$contact_num = mysqli_real_escape_string($db_connect, $_POST['cont_num']);

		if(empty($username) or empty($email) or empty($pass1) or empty($pass2) or empty($contact_num)){
            echo '<script language="javascript">';
			echo 'alert("All fields are required!")';
			echo '</script>';    
		}

	//	if((preg_match(" ", $username)) or (preg_match(" ", $pass1))){
          //              header("location:signup.php?msg=White Space are not allowed!");
            //            die();
              //  }

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			header("location:signup.php?msg=Invalid Email");
			die();
		}
		else{
			$check_email = mysqli_query($db_connect, "select email from users where email = '$email'");
			$count = mysqli_num_rows($check_email);
			if($count > 0)
			{
				echo '<script language="javascript">';
				echo 'alert("This account already exist!")';
				echo '</script>';
			}
		}

		if($pass1 == $pass2){
			//$hashed_pwd = password_hash($pass1, PASSWORD_DEFAULT);
			$insert_query = mysqli_query($db_connect, "insert into users(user_name, email, password, contact_num) VALUES('$username', '$email', '$pass1', '$contact_num')");
			if($insert_query){
				header("location:success.php");
			}
			else{
				echo "Registration was unsuccessful!";
			}
		}
		else {
			echo '<script language="javascript">';
			echo 'alert("Passwords do not match!")';
			echo '</script>';
			//header("location:signup.php?msg=Passwords do not match!");
			//die();
		}
		
		// the message
		$msg = "Welcome to the MNB Football Pitches Website.";

		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,70);

		// send email
		mail($email,"My subject",$msg);		
	}
?>

<html>
	<link rel="stylesheet" href="../css/mystyle.css"/>
	<body>
		<div class="container">
		<div class="information">
                        <h1 id="mnb" style="color:#4CAF50;">Sports KG</h1>

                        <p id="info">This site provides you quick booking of the mini-football pitches within the city Right from your device. In addition, you can search for other Sport Clubs through Kyrgyzstan.</p>
                </div>
		<div class="my-form" style="padding-right:5%;">
		<h3 align="center" style="margin-top: 2%">Please Sign Up to Continue</h3>
		<form method="post" action="signup.php" autocomplete="off">
			<label>Name</label>
			<input type="text" class="inputForm" name="username"  placeholder="Your name.." required>
			<labvel>Email</label>
			<input type="email" class="inputForm" name="email" placeholder="Your email..." required>
			<label>Contact Number</label>
                        <input type="text" class="inputForm" name="cont_num" placeholder="Your Contact Number.." required>
			<label>Password</label>
			<input type="password" class="inputForm" name="pass1" placeholder="Type Password.." required>
			<label>Re-enter Password</label>
			<input type="password" class="inputForm" name="pass2" placeholder="Re-enter password.." required>
			<input type="submit" name="register" class="submit_btn" style="margin-left:40%;"  value="Submit">
		</form>
		</div>
		</div>
	</body>
</html>
