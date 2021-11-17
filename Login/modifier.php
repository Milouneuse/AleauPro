<?php include('server.php'); 
	  ?>
<?php if(!isset($_SESSION["username"]))
		header('location: ./../index.php');
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifier Informations</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<style>
    .box{
        display: none;
    }
    label{ margin-right: 15px; }
</style>
</head>
<body>
	<div id="navbar" class="navbar">
		<!-- notification message -->
		<?php 
			include "NavBar.php";
			echo '</div>';

		?>
<div class="layer">
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src='captcha.js'></script>
	<div class="header">
		<h2>Modifier Informations</h2>
	</div>
	
	
	<script>
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});

</script>

	<form style="width: 60%;">
		<?php include('errors.php'); ?>
		<div class="radio-toolbar">
			<input type="radio" id="username" name="radioFruit" value="username" checked>
			<label for="username">Username</label>

			<input type="radio" id="password" name="radioFruit" value="password">
			<label for="password">Password</label>

			<input type="radio" id="email" name="radioFruit" value="email">
			<label for="email">Email</label> 
			
			<input type="radio" id="phone" name="radioFruit" value="phone">
			<label for="phone">Phone</label> 
		</div>
		<?php 
			include('../Classes/Utilisateurs/Clients.php');
			$Client = new Clients();
			$clientList = $Client->getByID($_SESSION["id"]); 
			if($clientList->entraineur){
				echo"<div class='radio-toolbar'>";
				echo"<input type='radio' id='ecole' name='radioFruit' value='ecole'>";
				echo"<label for='ecole'>École</label>";
				echo"<input type='radio' id='travail' name='radioFruit' value='travail'>";
				echo"<label for='travail'>Travail</label>";
				echo"<input type='radio' id='bio' name='radioFruit' value='bio'>";
				echo"<label for='bio'>Bio</label>";
				echo"</div>";
			}
		
		?>
	</form>
	
		
	<div class="username box">
		<p class="randomTextInfo"> Pour changer votre <strong>USERNAME</strong> entrez en un nouveau et validez votre mot de passe.	</p>
		<p class="randomTextInfo modTextUnderline">Votre username actuel est : <?php echo $_SESSION['username']; ?></p>
		<form method="post" action="modifier.php">
			<div class="form__group field">
				<input class="form__field" placeholder="New Username" type="text" name="newusername" id='user' required />
				<label for="user" class="form__label">New Username</label>
			</div>
			<div class="form__group field">
				<input class="form__field" placeholder="Password" type="password" name="password" id='pass' required />
				<label for="pass" class="form__label">Password</label>	
			</div>
			<div class="field-group" style="padding-top:10px; padding-bottom:5px;">
				<div style="display:inline">
					<p style="float:right">
						<a class="linkRandom" href="changePassword.php">Forgot Password</a>
					</p>
				</div>
			</div>
			<div class="form__group field">
				<button type="submit" class="btn" name="modusername">Change username</button>
			</div>
		</form>
	</div>
	
	<div class="password box">
		<p class="randomTextInfo modTextUnderline">Pour changer votre <strong>PASSWORD</strong> entrez en un nouveau et confirmez-le.</p>
		<form method="post" action="modifier.php">
			<div class="form__group field">
				<input class="form__field" placeholder="Old Password" type="text" name="oldpassword" id='oldpw' required />
				<label for="oldpw" class="form__label">Old Password</label>
			</div>
			<div class="form__group field">
				<input class="form__field" placeholder="New Password" type="password" name="newpassword" id='newpw' required />
				<label for="newpw" class="form__label">New Password</label>	
			</div>
			<div class="form__group field">
				<input class="form__field" placeholder="Confirm New Password" type="password" name="newpasswordconfirmation" id='newpwconf' required />
				<label for="newpwconf" class="form__label">Confirm New Password</label>	
			</div>
			<div class="field-group" style="padding-top:10px; padding-bottom:5px;">
				<div style="display:inline">
					<p style="float:right">
						<a class="linkRandom" href="changePassword.php">Forgot Password</a>
					</p>
				</div>
			</div>
			<div class="form__group field">
				<button type="submit" class="btn" name="modpassword">Change Password</button>
			</div>
		</form>
	</div>
	
	<div class="email box">
		<p class="randomTextInfo">Pour changer votre <strong>EMAIL</strong> entrez votre nouvel email, votre mot de passe et allez ensuite confirmer votre nouvel email.</p>
		<p class="randomTextInfo modTextUnderline">Votre email actuel : <?php connect(); GetEmail($_SESSION["username"]);?></p>
		<form method="post" action="modifier.php">
			<div class="form__group field">
				<input class="form__field" placeholder="New Email" type="text" name="newemail" id='nmail' required />
				<label for="nmail" class="form__label">New Email</label>
			</div>
			<div class="form__group field">
				<input class="form__field" placeholder="Password" type="password" name="password" id='pass' required />
				<label for="pass" class="form__label">Password</label>	
			</div>
			<div class="field-group" style="padding-top:10px; padding-bottom:5px;">
				<div style="display:inline">
					<p style="float:right">
						<a class="linkRandom" href="changePassword.php">Forgot Password</a>
					</p>
				</div>
			</div>
			<div class="form__group field">
				<button type="submit" class="btn" name="modemail">Change Email</button>
			</div>
		</form>
	</div>

	<div class="phone box">
		<p class="randomTextInfo">Pour changer votre <strong>PHONE</strong> entrez votre nouveau numéro et validez votre mot de passe.</p>
		<p class="randomTextInfo modTextUnderline">Votre numéro actuel est : <?php connect(); GetPhone($_SESSION["username"]); ?> </p>
		<form method="post" action="modifier.php">
			<div class="form__group field">
				<input class="form__field" placeholder="New Phone" type="text" name="newphone" pattern="[0-9]{10}" id='tel' required />
				<label for="tel" class="form__label">New Phone</label>
			</div>
			<div class="form__group field">
				<input class="form__field" placeholder="Password" type="password" name="password" id='pass' required />
				<label for="pass" class="form__label">Password</label>			
			</div>
			<div class="field-group" style="padding-top:10px; padding-bottom:5px;">
				<div style="display:inline">
					<p style="float:right">
						<a class="linkRandom" href="changePassword.php">Forgot Password</a>
					</p>
				</div>
			</div>
			<div class="form__group field">
				<button type="submit" class="btn" name="modphone">Change Phone</button>
			</div>
		</form>
	</div>

	<div class="ecole box">
		<p class="randomTextInfo">Pour changer votre <strong>école</strong> entrez votre nouvelle école</p>
		<form method="post" action="../forms/processEntraineur.php">
			<div class="form__group field">
				<input class="form__field" placeholder="Nouvelle école" type="text" name="ecolee" id='ecolee' required />
				<input name='switch' id='switch' type='hidden' value='ecole'/>
				<label for="ecolee" class="form__label">Nouvelle école</label>
			</div>
			<div class="form__group field">
				<button type="submit" class="btn" name="modphone">Changer école</button>
			</div>
		</form>
	</div>

	<div class="travail box">
		<p class="randomTextInfo">Pour changer votre <strong>travail</strong> entrez votre nouveau travail</p>
		<form method="post" action="../forms/processEntraineur.php">
			<div class="form__group field">
				<input class="form__field" placeholder="nouveau travail" type="text" name="travaill" id='travaill' required />
				<input name='switch' id='switch' type='hidden' value='travail'/>
				<label for="travaill" class="form__label">Nouveau travail</label>
			</div>
			<div class="form__group field">
				<button type="submit" class="btn" name="modphone">Changer école</button>
			</div>
		</form>
	</div>

	<div class="bio box">
		<p class="randomTextInfo">Pour changer votre <strong>bio</strong> entrez votre nouvelle bio</p>
		<form method="post" action="../forms/processEntraineur.php">
			<div class="form__group field">
				<textarea class="form__field" placeholder="nouvelle bio" type="text" name="bioo" id='bioo' required></textarea>
				<input name='switch' id='switch' type='hidden' value='bio'/>
				<label for="bioo" class="form__label">Nouvelle bio</label>
			</div>
			<div class="form__group field">
				<button type="submit" class="btn" name="modphone">Changer bio</button>
			</div>
		</form>
	</div>
		

</body>
</html>