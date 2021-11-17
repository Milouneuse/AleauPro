<?php include('server.php') ?>
<?php
require_once "./../Classes/SQL/Connexion.php";

date_default_timezone_set('America/Toronto');
	if(isset($_POST["changeMail"])) {

		$conn = Connexion::getLink();
		$email = $conn->real_escape_string($_GET['email']);
		$token = $conn->real_escape_string($_GET['token']);
		$response = $conn->real_escape_string($_GET['confirmation']);
		$query = "UPDATE `dbequipe01`.`clients` set token=null, tokenExpire=null where token='" . $token . "' and email ='" . $email . "'";
		mysqli_query($conn, $query);
		$sql = "UPDATE `dbequipe01`.`clients` SET `email` = '" . $_POST["member_email"]. "' WHERE `clients`.`email` = '" . $_GET["email"] . "'";
		$result = mysqli_query($conn,$sql);
		//$success_message = "Password is reset successfully. You may close this page !";	FONCTIONNE PAS
		$_SESSION["success"] = "Email successfully changed";
		header('Location:  ./../index.php?SuccessMessage=Email%20successfully%20changed!');
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
		
		$response = $conn->real_escape_string($_GET['confirmation']);

		
if(mysqli_num_rows($result) > 0)
{
	
	if($response == 'yes') 
	{
		$res = GetNewMailByToken($token);
		$mail = $res->fetch_array()[0];
		$sql = "UPDATE clients SET email = '" . $mail . "' WHERE token = '" . $token . "'";
		$conn->query($sql);
		$sql = "UPDATE `dbequipe01`.`clients` SET `newEmail` = '" . null . "' WHERE `clients`.`token` = '" . $token . "'";
		mysqli_query($conn, $sql);
		$sql = "UPDATE `dbequipe01`.`clients` SET `tokenExpire` = '" . null . "' WHERE `clients`.`token` = '" . $token . "'";
		mysqli_query($conn, $sql);
		$sql = "UPDATE `dbequipe01`.`clients` SET `token` = '" . null . "' WHERE `clients`.`token` = '" . $token . "'";
		mysqli_query($conn, $sql);
		$_SESSION['success'] = "Email changé !";
		header('Location: ./../index.php');
		exit();
	}
	if($response == 'no') 
	{
		$sql = "UPDATE `dbequipe01`.`clients` SET `newEmail` = '" . null . "' WHERE `clients`.`token` = '" . $token . "'";
		mysqli_query($conn, $sql);
		$sql = "UPDATE `dbequipe01`.`clients` SET `tokenExpire` = '" . null . "' WHERE `clients`.`token` = '" . $token . "'";
		mysqli_query($conn, $sql);
		$sql = "UPDATE `dbequipe01`.`clients` SET `token` = '" . null . "' WHERE `clients`.`token` = '" . $token . "'";
		mysqli_query($conn, $sql);
		$_SESSION['success'] = "Email inchangé !";
		header('Location: ./../index.php');
	}
	
} 
else 
{
	header('Location: modifier.php?ErrorMSG=Token%20Expired!');
	exit();
}
?>
				
<link href="demo-style.css" rel="stylesheet" type="text/css">
<script>
function validate_password_reset() {
	if((document.getElementById("member_email").value == "") && (document.getElementById("confirm_email").value == "")) {
		document.getElementById("validation-message").innerHTML = "Please enter new email!"
		return false;
	}
	if(document.getElementById("member_email").value  != document.getElementById("confirm_email").value) {
		document.getElementById("validation-message").innerHTML = "Both email should be same!"
		return false;
	}
	
	return true;
}
</script>
