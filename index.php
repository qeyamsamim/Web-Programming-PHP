<?php # if (($_SERVER['PHP_AUTH_USER'] != 'mnb') ||
#        ($_SERVER['PHP_AUTH_PW'] != 'mnb1'))
#        {
#        header('WWW-Authenticate: Basic Realm="Secret Stash"');
#        header('HTTP/1.0 401 Unauthorized');
#        print('You must provide the proper credentials!');
#        exit;
#        }
?>

<html>
	<link rel="stylesheet" href="css/mystyle.css"/>

	<div class="container">
		<div class="information">
			<h1 id="mnb" style="color:#4CAF50;">Sports KG</h1>
	
			<p id="info">This site provides you quick booking of the mini-football pitches within the city Right from your device. In addition, you can search for other Sport Clubs through Kyrgyzstan.</p>
		</div>
		<aside id="login">
			<form  class="my-form" action="include/login.inc.php" method="POST" autocomplete="off">
				<h1 id="login">Login</h1>
				<div class="form-group">
					<label>Email</label>
					<input type="email" id="uid" name="uid" class="inputForm" aria-required="true" required placeholder="Your Email..">
				</div>
				<div class="form-group"> 
					<label>Password</label>
					<input type="password" id="pwd" name="pwd" class="inputForm" aria-required="true" required placeholder="Type Password..">
				</div>
				<div class="button">
					<button  class="submit_btn" type="submit" name="submit">Login</button>
				</div>
				<div class="register">
					<a href="pages/signup.php" style="float:right">Don't have an account</a>
				</div>
			</form>
		</aside>
	</div>
</html>















