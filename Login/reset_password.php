<?php
session_start();
require_once "./../Classes/SQL/Connexion.php";

date_default_timezone_set('America/Toronto');
	if(isset($_POST["reset-password"])) {

		$conn = Connexion::getLink();
		$email = $conn->real_escape_string($_GET['email']);
		$token = $conn->real_escape_string($_GET['token']);
		$sql = "UPDATE `dbequipe01`.`clients` SET `password` = '" . md5($_POST["member_password"]). "' WHERE `clients`.`token` = '" . $token . "'";
		$result = mysqli_query($conn,$sql);
		$query = "UPDATE `dbequipe01`.`clients` set token=null, tokenExpire=null where token='" . $token . "'";
		mysqli_query($conn, $query);
		
		//$success_message = "Password is reset successfully. You may close this page !";	FONCTIONNE PAS
		$_SESSION["success"] = "Password successfully changed";
		header('Location:  ./../index.php?SuccessMessage=Password%20successfully%20changed!');
		exit();
		
	}
?>
<?php
 require_once "./../Classes/SQL/Connexion.php";

$conn = Connexion::getLink();
		$email = $conn->real_escape_string($_GET['email']);
		$token = $conn->real_escape_string($_GET['token']);

		//Ici, l'idée est de tester si le token et l'email dans le URL envoyé existent dans la db et que le token n'a pas encore expiré (5 minutes).
		$query = "SELECT * from `dbequipe01`.`clients` where token='" . $token . "' AND email='" . $email . "' AND tokenExpire > NOW()";
		$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0)
{
    // row exists. do whatever you would like to do.


		//if ($sql->num_rows > 0) {
			echo'
<head>
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="navbar" class="navbar">
		<!-- notification message -->
		';
			include "NavBar.php";
			echo '</div>';
echo'<div class="layer"></div>';
echo'	
<div class="header">
	<h2>Reset Password</h2>
</div>
<form name="frmReset" id="frmReset" method="post" onSubmit="return validate_password_reset();">

	<?php if(!empty($success_message)) { ?>
	<div style="text-align:center;
	color: #07AB61;" class="success_message"><?php echo $success_message; ?></div>
	<?php } ?>

	<div id="validation-message" style="color:#FF0000;text-align:center;">
		<?php if(!empty($error_message)) { ?>
	<?php echo $error_message; ?>
	<?php } ?>
	</div>

	
	<div class="form__group field">
		<input class="form__field" placeholder="Password" type="password" name="member_password" id="member_password" required />
		<label for="member_password" class="form__label">Password</label>
	</div>
		
	<div class="form__group field">
		<input class="form__field" placeholder="Confirmation" type="password" name="confirm_password" id="confirm_password" required />
		<label for="confirm_password" class="form__label">Confirm Password</label>
	</div>
	
	<div class="form__group field">
		<button type="submit" class="btn" name="reset-password">Change Password</button>
	</div>
	
</form>
</body>';
		} else {
		header('Location: changePassword.php?ErrorMSG=Token%20Expired!');
		exit();
	}
?>
				
<link href="demo-style.css" rel="stylesheet" type="text/css">
<script>
function validate_password_reset() {
	if((document.getElementById("member_password").value == "") && (document.getElementById("confirm_password").value == "")) {
		document.getElementById("validation-message").innerHTML = "Please enter new password!"
		return false;
	}
	if(document.getElementById("member_password").value  != document.getElementById("confirm_password").value) {
		document.getElementById("validation-message").innerHTML = "Both password should be same!"
		return false;
	}
	
	return true;
}
</script>
