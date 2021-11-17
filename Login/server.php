<?php 
	session_start();
	date_default_timezone_set('America/Toronto');
	

    require_once "../Classes/SQL/Connexion.php";

	// variable declaration

	$username = "";
	$email    = "";
	$errors = array(); 
	unset($_SESSION['success']);

	// connect to database
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


	// méthode de classe?
	function getUserByEmail($email)
    {
        $conn = connect();
        $sql = "SELECT * FROM clients WHERE email='$email'";
        $result = $conn->query($sql);
        $conn -> close();
        return $result;
    }
	
	function getUserByUsername($user)
    {
        $conn = connect();
        $sql = "SELECT * FROM clients WHERE username='$user'";
        $result = $conn->query($sql);
        $conn -> close();
        return $result;
    }
	
	function getUserByPhone($phone)
	{
		$conn = connect();
		$sql = "SELECT * FROM clients where telephone='$phone'";
		$result = $conn->query($sql);
		$conn -> close();
		return $result;
	}
	
	
	
	function GetEmail($username) {
		$conn = connect();
		
		if ($conn->connect_error) {
			die("Connection à échoué: " . $conn->connect_error);
		}
		$sql = "SELECT email FROM clients WHERE username='$username'";
		
		
		if($result = $conn->query($sql)) {
			while ($row = $result->fetch_assoc()) {			
				echo $row["email"];
			}
		}
		$conn->close();
	}
	
	function GetPhone($username) {
		$dbName = 'dbequipe01';
		$dbuser = 'equipe01'; // Devra changer
		$dbpass = 'in9vest01'; // devra changer
		$dbhost = '167.114.152.54'; // Devra changer pour l'adresse du serveur sur lequel le projet est!
	// Create connection
		$conn = new mysqli($dbhost,$dbuser,$dbpass,$dbName);
		
		if ($conn->connect_error) {
			die("Connection à échoué: " . $conn->connect_error);
		}
		$sql = "SELECT telephone FROM clients WHERE username='$username'";
		
		
		if($result = $conn->query($sql)) {
			while ($row = $result->fetch_assoc()) {			
				echo $row["telephone"];
				break;
			}
		}
		$conn->close();
	}
	
	function GetNewMailByToken($token) {
		$conn = connect();
		$sql = "SELECT newEmail FROM clients WHERE token='$token'";
		$result = $conn->query($sql);
		$conn -> close();
		return $result;
	}
	
	function GetId($username) {
		$conn = connect();
		$sql = "SELECT id FROM clients WHERE username='$username'";
		$result = $conn->query($sql);
		$conn -> close();
		return $result;
	}
	
	function generateExpireDates() {
		$t = strtotime('+5 minutes');
		return date('Y-m-d H:i:s', $t);
	}
	
	function generateTodayDate() {
		return date('Y-m-d H:i:s');
	}
	
	function generateMinimumTreize() {
		$t = strtotime('-13 years');
		return date('Y-m-d', $t);
	}
	
	function generateMaximumCent() {
		$t = strtotime('-100 years');
		return date('Y-m-d', $t);
	}
	
	function generateNewStrings($len = 10) {
		$token = "poiuztrewqasdfghjklmnbvcxy1234567890";
		$token = str_shuffle($token);
		$token = substr($token, 0, $len);

		return $token;
	}
	
	
	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$nom = mysqli_real_escape_string($db, $_POST['nom']);
		$prenom = mysqli_real_escape_string($db, $_POST['prenom']);
		$telephone = mysqli_real_escape_string($db, $_POST['telephone']);
		$cresponse = urlencode($_REQUEST['g-recaptcha-response']);
		$date = mysqli_real_escape_string($db, $_POST['dateNaissance']);
		$sexe = $_POST['genre'];

		
		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username est obligatoire"); }
		if (empty($prenom)) { array_push($errors, "Prénom est obligatoire"); }
		if (empty($nom)) { array_push($errors, "Nom de famille est obligatoire"); }
		if (empty($telephone)) { array_push($errors, "Numéros de téléphone est obligatoire"); }
		if (empty($email)) { array_push($errors, "Email est obligatoire"); }
		if (empty($password_1)) { array_push($errors, "Password est obligatoire"); }
		if (empty($cresponse)) { array_push($errors, "Captcha est obligatoire"); }
		if (empty($date)) { array_push($errors, "Date de naissance obligatoire"); }
		if (empty($sexe)) { array_push($errors, "Genre obligatoire"); }
		if (!empty($email)) {
			$result = getUserByEmail($email);
			if(mysqli_num_rows($result) != 0)
			{
				array_push($errors, "Email est déjà utilisé"); 
			}
		}
		

		$dateMini = generateMinimumTreize();
		$dateMaxi = generateMaximumCent();
		
		if ($date > $dateMini)
		{
			array_push($errors, "Vous êtes trop jeune.");
		}
		
		if ($date < $dateMaxi)
		{
			array_push($errors, "L'entrainement physique est risquée à votre âge");
		}
		
		
		
		
		if ($password_1 != $password_2) {
			array_push($errors, "Les deux mots de passe ne concorde pas");
		}
		if($cresponse!=$_SESSION['custom_captcha'])
		{
			array_push($errors, "Le captcha n'est pas bien recopier");
		}
		if(!empty($username)) {
			$result = getUserByUsername($username);
			if(mysqli_num_rows($result) != 0)
			{
				array_push($errors, "Le username est déjà pris"); 
			}
		}
		if(!empty($telephone)) {
			$result = getUserByPhone($telephone);
			if(mysqli_num_rows($result) != 0)
			{
				array_push($errors, "Le numero est déjà pris");
			}
		}

		//Ici le user n'a pas encore activé son compte, la variable active est donc a 0.
		// register user if there are no errors in the form
		if (empty($errors) && $cresponse==$_SESSION['custom_captcha']) {
			$date = generateExpireDates();
			$tokenCreation = generateNewStrings();
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO clients (username, email, password, nom, prenom, telephone, dateNaissance, sexe, active, tokenCreation, tokenExpire, admin) 
					  VALUES('$username', '$email', '$password', '$nom', '$prenom', '$telephone', '$date', '$sexe', '0', '$tokenCreation', '$date', 0)";
			mysqli_query($db, $query);

require_once("mail_configuration.php");
require("forgot-password-recovery-mail.php");
$mail = new PHPMailer();

$emailBody = "<div>" . $user["prenom"] . ",<br><br><p>Click this to confirm the account creation : <br><a href='" . "http://167.114.152.54/~Aleaupro2020/Login/creationConfirmation.php?email=" . $email. "&tokenCreation=" . $tokenCreation ."&confirmation=yes"."'>"
 . "Confirm Account Creation"."</a><br>The account will be deleted 5 minutes after the email has been sent, if so, you will need to create the account again.<br><br>
 <p>If you want to cancel the account creation, please click this : <br><a href='" . "http://167.114.152.54/~Aleaupro2020/Login/creationConfirmation.php?email=" . $email. "&tokenCreation=" . $tokenCreation ."&confirmation=no"."'>"
 . "Cancel Account Creation"."</a>
 <br><br></p>Regards,<br> Admin.</div>";

$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "ssl";
$mail->Port     = 465;  
$mail->Username = 'aleaupro@gmail.com';
$mail->Password = 'aleaupromdp!';
$mail->Host     = 'smtp.gmail.com';

$mail->SetFrom('aleaupro@gmail.com', 'Support');
$mail->AddReplyTo('aleaupro@gmail.com', 'Support');
$mail->ReturnPath='aleaupro@gmail.com.com';	
$mail->AddAddress($email);
$mail->Subject = "Confirmation d'une creation de compte";		
$mail->MsgHTML($emailBody);
$mail->IsHTML(true);

if(!$mail->Send()) {
	$error_message = 'Il y a eu un problème pour l envoi d un email !';
} else {
	$success_message = 'Regarde tes emails pour réinitialiser ton mot de passe!';
}			
			
			$_SESSION['success'] = "Va voir tes emails pour confirmer ton inscription !";
			header('location: ./../index.php');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$cresponse = urlencode($_REQUEST['g-recaptcha-response']);

		if (empty($username)) {
			array_push($errors, "Username est obligatoire");
		}
		if (empty($password)) {
			array_push($errors, "Mot de passe est obligatoire");
		}
		if (empty($cresponse)) {
			array_push($errors, "Captcha est obligatoire");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			
		
			$query = "SELECT * FROM clients WHERE username='$username' AND password='$password' AND active=1"; // Changer les users pour les clients

			$results = mysqli_query($db, $query);
			$testCombi = "SELECT * FROM clients WHERE username='$username' AND password='$password'";
			
			$resultatsCombi = mysqli_query($db, $testCombi);
			$testActif = "SELECT * FROM clients WHERE username='$username' AND password='$password' AND active=1";

			$admin = "SELECT * FROM clients WHERE username='$username' AND password='$password' AND active=1 AND admin=1";

			$resultatsActif = mysqli_query($db, $testActif);

			$resultatsAdmin = mysqli_query($db, $admin);
			echo "Resulta Admin ";

			if (mysqli_num_rows($results) == 1 && $cresponse==$_SESSION['custom_captcha']) {

				$_SESSION['username'] = $username;
				$_SESSION['success'] = "Bienvenue " . $_SESSION["username"] . ", vous êtes bien connecté sur AleauPro";
				$res = GetId($username);
				$_SESSION['id'] = $res->fetch_array()[0];
				if(mysqli_num_rows($resultatsAdmin) == 1) 
					$_SESSION['admin'] = '1';
			
				header('location: ./../index.php');
			}
			else if (mysqli_num_rows($resultatsCombi) == 0) {
				array_push($errors, "Mauvaise combinaison mot de passe/username");
			}
			else if (mysqli_num_rows($resultatsActif) == 0) {
				array_push($errors, "Compte n'est pas confirmé");
			}
		}
	}
	
	
	//CHANGE username
	
	if (isset($_POST['modusername'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['newusername']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$olduser = $_SESSION['username'];

		
		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Un nouveau username est obligatoire"); }
		if (empty($password)) { array_push($errors, "Mot de passe est obligatoire"); }

		if(!empty($username)) {
			$result = getUserByUsername($username);
			if(mysqli_num_rows($result) != 0)
			{
				array_push($errors, "Le username est déjà pris '$username' "); 
			}
		}
		
		
		// change username if no errors 
		
		if (empty($errors)) {
			
			$password = md5($password);
			
			$query = "SELECT * FROM clients WHERE username='$olduser' AND password='$password' AND active=1"; // Changer les users pour les clients

			$results = mysqli_query($db, $query);
			
			
			$testCombi = "SELECT * FROM clients WHERE username='$olduser' AND password='$password'";
			
			$resultatsCombi = mysqli_query($db, $testCombi);
			$testActif = "SELECT * FROM clients WHERE username='$olduser' AND password='$password' AND active=1";

			$admin = "SELECT * FROM clients WHERE username='$olduser' AND password='$password' AND active=1 AND admin=1";

			$resultatsActif = mysqli_query($db, $testActif);

			$resultatsAdmin = mysqli_query($db, $admin);

			if (mysqli_num_rows($results) == 1) {

				$_SESSION['username'] = $username;
				$_SESSION['success'] = "Username est changé";
				$query = "UPDATE clients SET username='$username' WHERE username='$olduser'";
				mysqli_query($db, $query);
				if(mysqli_num_rows($resultatsAdmin) == 1) 
					$_SESSION['admin'] = '1';
			}
			else if (mysqli_num_rows($resultatsCombi) == 0) {
				array_push($errors, "Mauvaise combinaison entre le username/mot de passe");
			}
			else if (mysqli_num_rows($resultatsActif) == 0) {
				array_push($errors, "Compte non confirmé");
			}
		}
	}
	
	
	//Modifier téléphone
	
	if (isset($_POST['modphone'])) {
		// receive all input values from the form
		$newphone = mysqli_real_escape_string($db, $_POST['newphone']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$olduser = $_SESSION['username'];

		
		// form validation: ensure that the form is correctly filled
		if (empty($newphone)) { array_push($errors, "Un nouveau numéro est obligatoire"); }
		if (empty($password)) { array_push($errors, "Mot de passe est obligatoire"); }

		if(!empty($olduser)) {
			$result = getUserByPhone($newphone);
			if(mysqli_num_rows($result) != 0)
			{
				array_push($errors, "Le téléphone est déjà pris '$newphone' "); 
			}
		}
		
		
		// change phone if no error
		
		if (empty($errors)) {
			
			$password = md5($password);
			
			$query = "SELECT * FROM clients WHERE username='$olduser' AND password='$password' AND active=1"; // Changer les users pour les clients

			$results = mysqli_query($db, $query);
			
			
			$testCombi = "SELECT * FROM clients WHERE username='$olduser' AND password='$password'";
			
			$resultatsCombi = mysqli_query($db, $testCombi);
			$testActif = "SELECT * FROM clients WHERE username='$olduser' AND password='$password' AND active=1";

			$admin = "SELECT * FROM clients WHERE username='$olduser' AND password='$password' AND active=1 AND admin=1";

			$resultatsActif = mysqli_query($db, $testActif);

			$resultatsAdmin = mysqli_query($db, $admin);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['success'] = "Téléphone est changé";
				$query = "UPDATE clients SET telephone='$newphone' WHERE username='$olduser'";
				mysqli_query($db, $query);
				if(mysqli_num_rows($resultatsAdmin) == 1) 
					$_SESSION['admin'] = '1';
			}
			else if (mysqli_num_rows($resultatsCombi) == 0) {
				array_push($errors, "Mauvaise combinaison entre le username/mot de passe");
			}
			else if (mysqli_num_rows($resultatsActif) == 0) {
				array_push($errors, "Compte non confirmé");
			}
		}
	}
	

	//CHANGE password
	
	if (isset($_POST['modpassword'])) {
		// receive all input values from the form
		$oldpw = mysqli_real_escape_string($db, $_POST['oldpassword']);
		$newpw = mysqli_real_escape_string($db, $_POST['newpassword']);
		$newpwc = mysqli_real_escape_string($db, $_POST['newpasswordconfirmation']);
		$olduser = $_SESSION['username'];
		
		// form validation: ensure that the form is correctly filled
		if (empty($oldpw)) { array_push($errors, "Entrez votre vieux mot de passe"); }
		if (empty($newpw)) { array_push($errors, "Entrez votre nouveau mot de passe"); }
		if ($newpw !== $newpwc) { array_push($errors, "Les deux doivent être le même"); }
		
		
		// change username if no errors 
		
		if (empty($errors)) {
			
			$password = md5($oldpw);
			
			$query = "SELECT * FROM clients WHERE username='$olduser' AND password='$password' AND active=1"; // Changer les users pour les clients

			$results = mysqli_query($db, $query);
			
			
			$testCombi = "SELECT * FROM clients WHERE username='$olduser' AND password='$password'";
			
			$resultatsCombi = mysqli_query($db, $testCombi);
			
			$testActif = "SELECT * FROM clients WHERE username='$olduser' AND password='$password' AND active=1";

			$admin = "SELECT * FROM clients WHERE username='$olduser' AND password='$password' AND active=1 AND admin=1";

			$resultatsActif = mysqli_query($db, $testActif);
			

			$resultatsAdmin = mysqli_query($db, $admin);
			echo "Resulta Admin ";
			

			if (mysqli_num_rows($results) == 1) {
				$passwordencrypted =  md5($newpw);
				$_SESSION['success'] = "Mot de passe changé";
				$query = "UPDATE clients SET password='$passwordencrypted' WHERE username='$olduser'";
				mysqli_query($db, $query);
				if(mysqli_num_rows($resultatsAdmin) == 1) 
					$_SESSION['admin'] = '1';
			}
			else if (mysqli_num_rows($resultatsCombi) == 0) {
				array_push($errors, "Mauvaise combinaison entre le username/mot de passe");
			}
			else if (mysqli_num_rows($resultatsActif) == 0) {
				array_push($errors, "Compte n'est pas confirmé");
			}
		}
	}
	
	
		//CHANGE Email //||\\ Y A DES ERREURS AVEC ENVOYER UN EMAIL DE MORT $USER $TOKEN MARCHE PAS, FAUT TROUVER POURQUOI MON GA YEEE
	
	
	if (isset($_POST['modemail'])) {
		// receive all input values from the form
		$newemail = mysqli_real_escape_string($db, $_POST['newemail']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$olduser = $_SESSION['username'];

		
		// form validation: ensure that the form is correctly filled
		if (empty($newemail)) { array_push($errors, "Un nouveau email est obligatoire"); }
		if (empty($password)) { array_push($errors, "Le mot de passe est obligatoire"); }

		if(!empty($newemail)) {
			$result = getUserByEmail($newemail);
			if(mysqli_num_rows($result) != 0)
			{
				array_push($errors, "Le email est déjà pris : '$newemail' "); 
			}
		}
		
		
		// change Email if no errors 
		
		if (empty($errors)) {
			$password = md5($password);
			
			$query = "SELECT * FROM clients WHERE username='$olduser' AND password='$password' AND active=1"; // Changer les users pour les clients

			$results = mysqli_query($db, $query);
			
			
			$testCombi = "SELECT * FROM clients WHERE username='$olduser' AND password='$password'";
			
			$resultatsCombi = mysqli_query($db, $testCombi);
			
			$testActif = "SELECT * FROM clients WHERE username='$olduser' AND password='$password' AND active=1";

			$admin = "SELECT * FROM clients WHERE username='$olduser' AND password='$password' AND active=1 AND admin=1";

			$resultatsActif = mysqli_query($db, $testActif);


			$resultatsAdmin = mysqli_query($db, $admin);

			if (mysqli_num_rows($results) == 1) {
				$date = generateExpireDates();
				$token = generateNewStrings();

				$query = "UPDATE clients set token='$token' where username='$olduser'";
				mysqli_query($db, $query);
				$query = "UPDATE clients set tokenExpire='$date' where username='$olduser'";
				mysqli_query($db, $query);
				$query = "UPDATE clients set newEmail='$newemail' where username='$olduser'";
				mysqli_query($db, $query);
				
				
				$sql = "Select * from clients where username='$olduser'";
				$result = mysqli_query($db,$sql);
				$user = mysqli_fetch_array($result);
				
				$_SESSION["newmail"] = $newemail;
				require("recoveryEmail.php");
				header('Location:  ./modifier.php?SuccessMessage=Check%20your%20email : ' . $newemail . '%20to%20continue!');
				
			}
		}
	}			
				



	
?>