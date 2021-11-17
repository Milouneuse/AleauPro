<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">


</head>


<body>
	<div id="navbar" class="navbar">
		<!-- notification message -->
		<?php 
			include "NavBar.php";
			echo '</div>';

		?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src='captcha.js'></script>
<div class="layer">
</div>
	<div class="header">
		<h2>Login</h2>
	</div>

<form method="post" action="login.php">

		<?php include('errors.php'); ?>

		<div class="form__group field">
			<input class="form__field" placeholder="Username" type="text" name="username" id='username' required />
			<label for="username" class="form__label">Username</label>
		</div>
		
		<div class="form__group field">
			<input class="form__field" placeholder="Password" type="password" name="password" id='password' required />
			<label for="password" class="form__label">Password</label>
		</div>
		
		
		<div class="form__group field">
			<div id="custom_captcha" style="padding-top:20px"></div>
			<label for="captcha" class="form__label">Captcha</label>
		</div>

			<div class="field-group" style="padding-top:10px">
				<div style="display:inline">
					<!--
					<input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
					<label class="labelRandom" for="remember-me">Remember me</label>
					-->
					<p style="float:right">
						<a class="linkRandom" href="register.php">Register</a>
					</p>
					<p style="float:left">
						<a class="linkRandom" href="changePassword.php">Forgot Password</a>
					</p>
				</div>
			</div>

		<div class="form__group field" style="margin-top:25px;">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
	 </form>
		
		

</body>
</html>