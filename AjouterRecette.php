<!DOCTYPE>

<?php include "Classes/Recette/Recette.php"; ?>
<?php include "Classes/Utilisateurs/Clients.php"; ?>
<?php session_start(); ?>
<html>
<head>
<meta content="width=device-width, initial-scale=1" name="viewport" />
	<title>Création Recette</title>
    <link rel="stylesheet" type="text/css" href="css.css">
	<link rel="stylesheet" type="text/css" href="cssSearchRecette.css">
</head>
<body>
	<div id="navbar" class="navbar onload" style="top: 0px;">
		<!-- notification message -->
		<?php 
			include "NavBar.php";
			echo '</div>';

		?>
	</div>
	<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
	<span style="font-size:30px;cursor:pointer; top:52px; position: fixed; color: black;" onclick="openNav()">&#9776;</span>
	<div id="mySidenav" class="sidenav" style="position:fixed;">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="ListRecette.php?catego=Dejeuner">Déjeuner</a>
		<a href="ListRecette.php?catego=Diner">Dîner</a>
		<a href="ListRecette.php?catego=Souper">Souper</a>
		<a href="ListRecette.php?catego=Collation">Collation</a>
		<a href="ListRecette.php?catego=Dessert">Dessert</a>
		<?php if(isset($_SESSION["username"]))
			echo
				'<a href="AjouterSpectacle.php">Soumettre une Recette</a>'
		?>	
		<?php if(isset($_SESSION["admin"]))
			echo
				'<a href="AjouterSpectacle.php">Vérifier une recette</a>'
		?>	
		</div>
	</div>

	<form>
		<div class="uneRecette" id="uneRecette">
			<div class="laRecette">
			
				<div class="recetteGaucheGrid"><!-- Debut Grille Gauche-->
			
					<div class="recetteTitre">
						<p class="creationTitre">Titre de votre recette</p>
						<input class="recetteInput" name="RecetteTitre" placeholder="Titre de la Recette">
					</div>

					<div class="recettePresentation">
						<p>Présentez et décrivez votre recette</p>
					</div>
					
					<div class="recetteEtape">
						<p class="titreSection">Étapes</p>
					</div>
				
				</div><!-- FIN GRILLE GAUCHE-->
				
				<div class="recetteDroiteGrid"><!-- Debut Grille DRoite-->
				
					<div class="recetteTitre">
					<p class="creationTitre">Catégorie</p>
						  <select name="categorie" class="recetteInput" id="categorie">
								<option value="Dejeuner">Déjeuner</option>
								<option value="Diner">Diner</option>
								<option value="Souper">Souper</option>
								<option value="Collation">Collation</option>
								<option value="Dessert">Dessert</option>
						</select>
					</div>
					
					<div class="recetteInfo">
						<div class="recetteImage">
						
						</div>
						
						<div class="recetteAuteur">
						<?php 
							echo'TON USERNAME';
						?>
						</div>
						
						<div class="recetteTemps">
						</div>
						
						<div class="recetteVideo">
						</div>
					</div>
					
					<div class="recetteIngredient">
						<p class="titreSection">Ingrédients</p>
					</div>
					
					<div class="recetteEtape2">
						<p class="titreSection">Étapes</p>
					</div>
					
					<div class="recetteValeur">
						<p class="titreSection">Valeurs Nutritives</p>
					</div>
					
				</div>
			</div>
	</form>
</body>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("uneRecette").style.marginLeft = "275px";
  document.getElementById("uneRecette").style.width = "calc(100vw - 325px)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("uneRecette").style.marginLeft = "50px";
  document.getElementById("uneRecette").style.width = "calc(100vw - 100px)";
}
</script>