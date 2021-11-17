<?php include "Classes/Entraineurs/Entraineurs.php"; ?>
<?php include "Classes/Utilisateurs/Clients.php"; ?>
<?php session_start();
    if(!isset($_SESSION["username"]))  
    header("location: Login/login.php");
    
    $client = new Clients;
    $id = $client->GetByUsername($_SESSION["username"]);
    if($client->GetForm($id))
    {
    header("location: index.php");
    $_SESSION["success"] = "Vous avez déjà fait une demande pour devenir un entraîneur, les administrateurs vont bientôt vous donner une réponse. Regardez bien vos courriels !";
    }
    else if(isset($_SESSION['entraineur']))
    $_SESSION["success"] = "Vous êtes déjà un entraîneur pour AleauPro !"
?>
<html>
<head>
	<title>Formulaire</title>
    <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
	<div id="navbar" class="navbar onload" style="top: 0px;">
		<!-- notification message -->
		<?php 
			include "NavBar.php";
			echo '</div>';

		?>
    </div>
    </div>
    <div class="container-info">
        <div class="info">
            Formulaire pour devenir un entraîneur AleauPro.
        </div>
    </div>
    <div class="entraineurForm">
    <form action="processForm.php" method="post" enctype="multipart/form-data">
    <div id="erreur" style="color: red;">  </div> <br>
    <label for="ecole">École où vous avez gradué</label>
    <input type="text" id="ecole" name="ecole" placeholder="Votre école .. (obligatoire)" required>

    <label for="annee">Année de graduation</label>
    <input type="date" id="annee" name="annee" placeholder="Année de graduation .. (obligatoire)" onchange="VerificationDate(event)" required/>

    <label for="experience">Année où vous avez commencé à exercé ce métier</label>
    <input type="date" id="experience" name="experience" placeholder="expérience .. (obligatoire)" onchange="VerificationDateCommencer(event)" required>

    <label for="travail">Lieu de travail</label>
    <input type="text" id="travail" name="travail" placeholder="Lieu de travail ..">

    <label for="experienceT">Date de l'embauche</label>
    <input type="date" id="experienceT" name="experienceT" placeholder="date de l'embauche .." onchange="VerificationDateEmbauche(event)">

    <label for="photoPermis"> Photo de votre permis de conduire </label>
    <input type="file" name="photoPermis" id="photoPermis" required>

    <label for="photoDiplome"> Photo de votre diplôme </label>
    <input type="file" name="photoDiplome" id="photoDiplome" required>

    <label for="bio">Votre mission</label>
    <textarea id="bio" name="bio" placeholder="Écrivez votre mission.." style="height:200px">
    </textarea>
    <input type="submit" name="upload" value="upload">
  </form>
    </div>

<script>
    function VerificationDate(anneeGraduation)
    {
        var dateGraduation = new Date(anneeGraduation.target.value).getTime()
        if(dateGraduation > new Date().getTime())
        {
            document.getElementById("erreur").innerHTML = "";
            document.getElementById("erreur").innerHTML = "La date de graduation ne doit pas être dans le future. Vous devez déjà posséder un diplôme pour postuler chez AleauPro";
            document.getElementById("annee").valueAsDate = null;
        }
    }
    function VerificationDateCommencer(anneeGraduation)
    {
        var dateGraduation = new Date(anneeGraduation.target.value).getTime()
        if(dateGraduation > new Date().getTime())
        {
            document.getElementById("erreur").innerHTML = "";
            document.getElementById("erreur").innerHTML = "Veuillez rentrer une date valide pour l'année où vous avez commencé à exercé ce métier.";
            document.getElementById("experience").valueAsDate = null;
        }
    }
    function VerificationDateEmbauche(anneeGraduation)
    {
        var dateGraduation = new Date(anneeGraduation.target.value).getTime()
        if(dateGraduation > new Date().getTime())
        {
            document.getElementById("erreur").innerHTML = "";
            document.getElementById("erreur").innerHTML = "Veuillez rentrer une date valide pour la date d'embauche.";
            document.getElementById("experienceT").valueAsDate = null;
        }
    }
</script>