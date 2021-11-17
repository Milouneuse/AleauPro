<?php include('server.php') ?>
<?php
	require_once "./../Classes/SQL/Connexion.php";
	date_default_timezone_set('America/Toronto');
	
	

	function generateNewString($len = 10) {
		$token = "poiuztrewqasdfghjklmnbvcxy1234567890";
		$token = str_shuffle($token);
		$token = substr($token, 0, $len);

		return $token;
	}
	$token = generateNewString();
	
	function generateExpireDate() {
		
		$t = strtotime('+5 minutes');
		return date('Y-m-d H:i:s', $t);
	}
	
//Insere un nouveau token dans la BD génère une date 5 minutes apres
	function insertToken($token) {
		$conn = Connexion::getLink(); // changer nom ici IcI
		$sql = "UPDATE `dbequipe01`.`clients` SET `token` = '" .  $token  . "' WHERE `clients`.`email` = '" . $_POST["user-email"] . "'";
		mysqli_query($conn, $sql);
		$sql = "UPDATE `dbequipe01`.`clients` SET `tokenExpire` ='" . generateExpireDate() . "' WHERE `clients`.`email` = '" . $_POST["user-email"] . "'";
		mysqli_query($conn, $sql);
	}
	
	
	if(!empty($_POST["forgot-password"]))
	{
		$conn = Connexion::getLink();
		
		$condition = "";

		if(!empty($_POST["user-email"])) {
			$condition = " email = '" . $_POST["user-email"] . "'";
		}
		
		if(!empty($condition)) {
			$condition = " where " . $condition . "AND active='1'";
		}

		$sql = "Select * from clients " . $condition;
		$result = mysqli_query($conn,$sql);
		$user = mysqli_fetch_array($result);
		
		if(!empty($user)) {
			insertToken($token);
			require_once("forgot-password-recovery-mail.php");
		} else {
			$error_message = 'No Active User Found';
		}
	}
?>

<script>
function validate_forgot() {
	if(document.getElementById("user-email").value == "") {
		document.getElementById("validation-message").innerHTML = "Email is required!"
		return false;
	}
	return true
}
</script>

<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="navbar" class="navbar">
		<!-- notification message -->
		<?php 
			include "NavBar.php";
			echo '</div>';

		?>
<div class="layer"></div>
	<div class="header">
		<h2>Forgot password</h2>
	</div>
	

	
	<form style="margin:auto;"name="frmForgot" id="frmForgot" method="post" onSubmit="return validate_forgot();">
	<?php include('errors.php'); ?>
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
			<input class="form__field" placeholder="Email" type="text" name="user-email" id='user-email' required />
			<label for="user-email" class="form__label">Email</label>
	</div>

	<div class="form__group field">
		<input class="btn" type="submit" name="forgot-password" id="forgot-password" value="Forgot Password" class="form-submit-button">
	</div>


	</form>


</body>
</html>