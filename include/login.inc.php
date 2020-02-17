<?php
session_start();
include("dbconnection.php");

	if (isset($_POST['submit'])) {
	        $uid = mysqli_real_escape_string($db_connect, $_POST['uid']);
        	$pwd = mysqli_real_escape_string($db_connect, $_POST['pwd']);


	        if (empty($uid) || empty($pwd)){
        	        header("Location: ../index.php?fields=empty");
                	exit();
	        } else {
        	        $sql = "SELECT * FROM users WHERE email = '$uid' and password = '$pwd'";
                	$result = mysqli_query($db_connect, $sql);
			//$rows = mysqli_fetch_array($result);
			//$password = $rows['password'];
			//$check_pwd = password_verify($pwd, $password);

	                $resultCheck = mysqli_num_rows($result);
			//header("location:../index.php?$password;");die();
			if ($resultCheck == 1) {
				//header("location:../index.php?$password;");die();
				//if($check_pwd == true){
					//header("location:../index.php?$Success;");die();
					$getUser = mysqli_fetch_array($result);
					$email = $getUser['email'];
					$_SESSION['email'] = $email;
					$id = $getUser['id'];
                        	        $_SESSION['id'] = $id;
					header("Location: ../pages/home.php?msg=$email");
					exit();
				//}else{
				//	header("location:../index.php?Failed;");
				//}
			} else {
				date_default_timezone_set("Kazakhstan/Astana");
				$mydate = date('l jS \of F Y h:i:s A');
				$logdata = "'$uid' ' $pwd' ' $mydate'";
				$insertLogData = "insert into logaction (email, password) values ('$uid', '$pwd');";
				$logsend =  mysqli_query($db_connect, $insertLogData);

				//customError($logdat

				//TODO solve problem with alert

				//echo "<script>alert('Addition Successfull !!');</script>";


				header("Location: ../index.php?invalid_email_password=$logdata");
				exit();

			}
        	}
	} else {
        	header("Location ../index.php");
	        exit();
	}


?>

	<?php 
/*function customError($error) {

			error_log("Error: [$error] ", 1, "email", "From login page");
			$insertLogError = "insert into errorLog(data) values($error);";
			mysqli_query($db_connect, $insertLogError);
		
		
		}
		set_error_handler("handleError");
*/

?>
