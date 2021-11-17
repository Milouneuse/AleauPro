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
		<h2>Register</h2>
	</div>
	
	<form method="post" action="register.php">

		<?php include('errors.php'); ?>

		<div class="form__group field">
			<input class="form__field" placeholder="Username" value="<?php echo $username; ?>" type="text" name="username" id='username' required />
			<label for="username" class="form__label">Username</label>
		</div>
		
		<div class="form__group field">
			<input class="form__field" placeholder="Email" type="email" name="email" id='email' value="<?php echo $email; ?>" required />
			<label for="email" class="form__label">Email</label>
		</div>
		
		<div class="form__group field">
			<input class="form__field" placeholder="Prenom" type="text" name="prenom" id='prenom' required />
			<label for="prenom" class="form__label">Prenom</label>
		</div>
		
		<div class="form__group field">
			<input class="form__field" placeholder="Nom" type="text" name="nom" id='nom' required />
			<label for="nom" class="form__label">Nom</label>
		</div>
		
		<div class="form__group field">
			<input class="form__field" placeholder="Telephone" type="tel" name="telephone" id='telephone' required />
			<label for="telephone" class="form__label">Telephone</label>
		</div>

		<div class="form__group field">
			<input style="width:75%; text-align:center;background:url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png)  97% 50% no-repeat ;"class="form__field" placeholder="Date Naissance" type="date" name="dateNaissance" id='dateNaissance' required />
			<label for="dateNaissance" class="form__label">Date Naissance</label>
		</div>
		<br>
		<br>
		
		<div class="from__group field" style="text-align:center;">
			  <select name="genre" id="genre" class="input-group" style="width:75%; height:30px; text-align:center;">
			  <option value="" selected disabled hidden>Genre</option>
			  <option value="Male">Male</option>
			  <option value="Female">Female</option>
			  <option value="Other">Other</option>
			  </select>
		</div>
		
		<div class="form__group field">
			<input class="form__field" placeholder="Password" type="password" name="password_1" id='password1' required />
			<label for="password1" class="form__label">Password</label>
		</div>
		
		<div class="form__group field">
			<input class="form__field" placeholder="Confirmation" type="password" name="password_2" id='password2' required />
			<label for="password2" class="form__label">Password Confirmation</label>
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
					<a class="linkRandom" href="login.php">Déjà membre</a>
				</p>
			</div>
		</div>
		
		<div class="form__group field" style="margin-top:25px;">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>
	</form>

</body>
</html>