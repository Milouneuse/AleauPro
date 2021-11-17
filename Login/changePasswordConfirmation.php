<?php include('server.php') ?>
<?php

if (isset($_GET['email']) && isset($_GET['token'])) {
		$conn = mysqli_connect("167.114.152.54", "equipe01", "in9vest01", "dbequipe01");
		$email = $conn->real_escape_string($_GET['email']);
		$token = $conn->real_escape_string($_GET['token']);

		$sql = $conn->query("SELECT id FROM users WHERE
			email='$email' AND token='$token' AND token<>'' AND tokenExpire > NOW()
		");

		if ($sql->num_rows > 1) {
			echo '
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="navbar" class="navbar">
		<!-- notification message -->
'
			include "NavBar.php";
			echo '</div>';
echo'<div class="layer"></div>';
echo'

	<div class="header">
		<h2>Forgot password</h2>
	</div>
	
	<form method="post" action="changePassword.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>New password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<label>New password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="forgot-password" id="forgot-password">Change password</button>
		</div>
	</form>


</body>
</html>'
		} else
			header('Location: login.php');
			exit();
	} else {
		header('Location: login.php');
		exit();
	}
	
}
	if(!empty($_POST["forgot-password"])){
		$conn = mysqli_connect("localhost", "root", "", "aleauprobd");
		
		$condition = "";
		if(!empty($_POST["user-login-name"])) 
			$condition = " member_name = '" . $_POST["user-login-name"] . "'";
		if(!empty($_POST["user-email"])) {
			if(!empty($condition)) {
				$condition = " and ";
			}
			$condition = " member_email = '" . $_POST["user-email"] . "'";
		}
		
		if(!empty($condition)) {
			$condition = " where " . $condition;
		}

		$sql = "Select * from members " . $condition;
		$result = mysqli_query($conn,$sql);
		$user = mysqli_fetch_array($result);
		
		if(!empty($user)) {
			require_once("forgot-password-recovery-mail.php");
		} else {
			$error_message = 'No User Found';
		}
	}
	
	
	
?>