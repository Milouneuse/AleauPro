<?php
	require_once ("/home/Aleaupro2020/public_html/Classes/SQL/Connexion.php");
	
	// variable declaration

	$username = "";
	$email    = "";
	$errors = array(); 

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
	
	function getResultCategory($query)
    {
        $conn = connect();
        $sql = "SELECT * FROM recette WHERE categorie='$query'";
        $result = $conn->query($sql);
        $conn -> close();
        return $result;
    }
	
	function getResultAuteur($query)
    {
        $conn = connect();
        $sql = "SELECT * FROM recette WHERE auteur='$query'";
        $result = $conn->query($sql);
        $conn -> close();
        return $result;
    }
	
	function getResultName($query)
    {
        $conn = connect();
        $sql = "SELECT * FROM recette WHERE nom like '%$query%'";
        $result = $conn->query($sql);
        $conn -> close();
        return $result;
    }
	
	if (isset($_POST['searchInBook'])) {
		$query = mysqli_real_escape_string($db, $_POST['query']);
		
		$result = getResultName($query);
		if(mysqli_num_rows($result) != 0)
		{
			header('location: ListRecette.php?nom='. $query);
			exit;
		}
		
		$result = getResultAuteur($query);
		if(mysqli_num_rows($result) != 0)
		{
			header('location: ListRecette.php?auteur='. $query);
			exit;
		}
			
		$result = getResultCategory($query);
		if(mysqli_num_rows($result) != 0)
		{
			header('location: ListRecette.php?catego='. $query);
			exit;
		}
		header('location: Recettes.php?erreur=Pas%20de%20correspondance');
		
		
	}
?>