<!DOCTYPE>

<?php include "Classes/Recette/Recette.php"; ?>
<?php include "Classes/Utilisateurs/Clients.php"; ?>
<?php session_start(); ?>
<html>
<head>
<meta content="width=device-width, initial-scale=1" name="viewport" />
	<title>Détails Recette</title>
    <link rel="stylesheet" type="text/css" href="css.css">
	<link rel="stylesheet" type="text/css" href="cssSearchRecette.css">
</head>
<?php 
$id = $_GET['id'];
$Recette = new Recette;
$Clients = new Clients;
$list = $Recette->getByID($id);
?>
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
	
	<div class="uneRecette" id="uneRecette">
		<div class="laRecette">
		<div class="recetteGaucheGrid">
			<div class="recetteTitre">
				<?php 
				echo $list->nom; 
				?>
			</div>
			<div class="recettePresentation">
			<?php 
				echo $list->presentation; 
				?>
			</div>
			<div class="recetteEtape">
				<p class="titreSection">Étapes</p>
			<?php 
				$id = $_GET['id'];
				$RecetteDet = new Recette;
				$liste = $RecetteDet->getListEtape($id);
				$count = sizeof($liste);
				for($x = 0; $x < $count; $x++)
				{
					if(isset($liste[$x]))
					{
						echo'<div class="etapeRecette" id="a' . $x .'">';
						echo $liste[$x]->idEtape;
						echo'. ';
						/*echo $liste[$x]->titreEtape;*/
						echo $liste[$x]->description;
						echo'</div><br>';
					}
				}
			?>
			</div>
			<div class="recetteNote">
				<p class="titreSection">Note</p>
			<?php 
				for($i = 0; $i < 5; $i++)
					{
						if($i < $list->note)
							echo'<span class="fa fa-star checked"></span>';
						else
							echo'<span class="fa fa-star"></span>';
					}
					echo'('. $list->note .')';
				?>
			</div>
		</div>
		<div class="recetteDroiteGrid">
			<div class="recetteTitre">
				<?php 
				echo $list->categorie; 
				?>
			</div>
			<div class="recetteInfo">
				<div class="recetteImage">
					<?php 
					echo'<img src="'. $list->image .'" alt="Default" style="width:80%; height:250px">';
					?>
				</div>
				<div class="recetteAuteur">
				<?php 
				echo'<p class="infoRecette">Auteur: ';
					echo $list->auteur; 
				?>
				</div>
				<div class="recetteTemps">
					<?php 
					echo'<p class="infoRecette">Prep time: ';
						echo $list->temps; 
					?>
				</div>
				<div class="recetteVideo">
					<?php 
					if(isset($list->urlVideo)){
						echo'<p class="infoRecette">Vidéo: ';
						echo $list->urlVideo; 
					}
					?>
				</div>
			</div>
			<div class="recetteIngredient">
			<p class="titreSection">Ingrédients</p>
			<?php 
				$id = $_GET['id'];
				$RecetteDet = new Recette;
				$listeIng = $RecetteDet->getListIngredient($id);
				$count = sizeof($listeIng);
				echo'<div class="gridIngredient">';
				for($x = 0; $x < $count; $x++)
				{
					if(isset($listeIng[$x]))
					{
						echo'<div class="ingredientRecette" id="Ing' . $x .'">';
						echo $listeIng[$x]->quantite;
						echo ' ';
						echo $listeIng[$x]->nomIngredient;
						echo'</div><br>';
					}
					
				}
				echo'</div>';
			?>
			</div>
			<div class="recetteEtape2">
				<p class="titreSection">Étapes</p>
			<?php 
				$id = $_GET['id'];
				$RecetteDet = new Recette;
				$liste = $RecetteDet->getListEtape($id);
				$count = sizeof($liste);
				for($x = 0; $x < $count; $x++)
				{
					if(isset($liste[$x]))
					{
						echo'<div class="etapeRecette" id="a' . $x .'">';
						echo $liste[$x]->idEtape;
						echo'. ';
						/*echo $liste[$x]->titreEtape;*/
						echo $liste[$x]->description;
						echo'</div><br>';
					}
				}
			?>
			</div>
			<div class="recetteValeur">
			<p class="titreSection">Valeurs Nutritives</p>
			<?php 
				$id = $_GET['id'];
				$RecetteDet = new Recette;
				$listeVN = $RecetteDet->getVN($id);
				$count = sizeof($listeVN);
				for($x = 0; $x < $count; $x++)
				{
					if(isset($listeVN[$x]))
					{
						echo'<div class="vnRecette">';
						echo $listeVN[$x]->calories;
						echo'Calories / ';
						echo $listeVN[$x]->fat;
						echo'g Fat / ';
						echo $listeVN[$x]->carbs;
						echo'g Carb / ';
						echo $listeVN[$x]->proteine;
						echo'g Protein';
					}
				}
			?>
			</div>
		</div>
		<div class="recetteNote2">
				<p class="titreSection">Note</p>
			<?php 
				for($i = 0; $i < 5; $i++)
					{
						if($i < $list->note)
							echo'<span class="fa fa-star checked"></span>';
						else
							echo'<span class="fa fa-star"></span>';
					}
					echo'('. $list->note .')';
				?>
			</div>
	</div>
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