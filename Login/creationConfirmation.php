<?php
    require_once "../Classes/SQL/Connexion.php";
	date_default_timezone_set('America/Toronto');
	SESSION_START();
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";
	
	$db = Connexion::getLink(); // A changer les infos ici!

	function connect(){
    // Create connection
    $conn = Connexion::GetConnexion();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    return $conn;
	}

			$email = $db->real_escape_string($_GET['email']);
		$token = $db->real_escape_string($_GET['tokenCreation']);
		$confirmation = $db->real_escape_string($_GET['confirmation']);
	$query = "SELECT * from `dbequipe01`.`clients` where email = '" . $email . "' AND tokenCreation = '" . $token . "'AND tokenExpire > NOW()";
	$result = mysqli_query($db,$query);

		
	if(mysqli_num_rows($result) > 0){
		$conn = Connexion::getLink(); // changer nom ici IcI
		if($confirmation == 'yes')
		{
			$sql = "UPDATE `dbequipe01`.`clients` SET `tokenCreation` = '" . null . "' WHERE `clients`.`email` = '" . $email . "'";
			mysqli_query($conn, $sql);
			$sql = "UPDATE `dbequipe01`.`clients` SET `active` = '1' WHERE `clients`.`email` = '" . $email . "'";
			mysqli_query($conn, $sql);
			$sql = "UPDATE `dbequipe01`.`clients` SET `tokenExpire` =null WHERE `clients`.`email` = '" . $email . "'";
			mysqli_query($conn, $sql);
		
			$_SESSION['success'] = "Account creation confirmed";
			header('location: ./../index.php?GG');
		}
		if($confirmation == 'no')
		{
			$sql = "Delete from clients where email = '$email'";
			mysqli_query($conn, $sql);
			$_SESSION['success'] = "Account creation canceled";
			header('location: ./../index.php?BG');
		}
	} 
	else
	{
			$error_message = 'No Pending Confirmation User Found';
			array_push($errors, "Bad username/password combination");
			header('location: ./../index.php?BG');
	}
?>