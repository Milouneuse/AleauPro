<!DOCTYPE>
<?php include('./Dom/DomRecette.php') ?>
<?php session_start(); ?>
<html>
<head>
	<title>Livre de Recettes</title>
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

		<!-- logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>
			<!-- <p>Welcome <strong><?php // echo $_SESSION['username']; ?></strong></p>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p> -->
		<?php endif ?>
	</div>
	
	<div id="main" class="onload" style="height:100%; position:absolute; width:100%; background-image: url('image/BGrecette.jpg'); background-repeat: no-repeat; background-size: 100% 100%;" >
	<span style="font-size:30px;cursor:pointer; top:52px; position: fixed; color: white; z-index:4;" onclick="openNav()">&#9776; Ouvrir le Menu</span>
	</div>
	
	<div id="bigThing"style=" width: -webkit-calc(100% - 250px);
				 width: -moz-calc(100% - 250px);
				 width:  calc(100% - 250px);
				 float:right;
				 height:100%;
				 left:-125px;
				 z-index:3;
				 position:relative;
				 transition:0.5s;">
		<h4 class="recetteTexte"style="position: absolute;
		top: 10%;
		text-align:center;
		font-size: 3rem;
		font-weight: 400;
		color : white;
		padding-right: 50px;
		"> 
		Les recettes santé AleauPro,
		de quoi vous mettre l'eau à la bouche...
		<form style="margin-top:20px; left" id="recetteSearchBar" action="Recettes.php" method="post" role="search">
			<label id="recetteSearchLabel" for="search">Search for stuff</label>
			<input name="query" class="recetteSearchInput"id="search" type="search" placeholder="<?php if(isset($_GET['erreur'])) echo $_GET['erreur'];
			else
				echo'Search...'?>" autofocus required />
			<button name="searchInBook" style="position:absolute;"id="recetteSearchBoutton" type="submit">Go</button>    
		</form>
		<br>
		<br>
		<br>
		De quoi avez-vous envie ?
		Entrez un tag, un auteur, un nom, une catégorie...
		</h4>
	</div>
	
	<div id="mySidenav" class="sidenav" style="position:fixed; z-index:5;">
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



<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("bigThing").style.paddingLeft = "25px";
  document.getElementById("bigThing").style.left = "0px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("bigThing").style.left = "-125px";
  document.getElementById("bigThing").style.paddingLeft = "0px";
}
</script>

</body>
	
