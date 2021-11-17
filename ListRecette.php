<!DOCTYPE>

<?php include "Classes/Recette/Recette.php";?>
<?php session_start(); ?>

<html>
<head>
<meta content="width=device-width, initial-scale=1" name="viewport" />
	<title>Liste Recette</title>
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
	<div id="listBG"class="listBG">
		<?php 
		
		if(isset($_GET['catego']))
		{	
		$catego = $_GET['catego'];
		$Recette = new Recette;
		$list = $Recette->getListRecetteCategorie($catego);
		$count = sizeof($list);
		for($x = 0; $x < $count; $x++)
		{
			if(isset($list[$x]))
             {
					echo'<div class="card" id="a' . $x .'">';
					echo'<img src="'. $list[$x]->image .'" alt="Default" style="width:100%; height:250px">';
					echo'<h3>' . $list[$x]->categorie . ' <br> ' . $list[$x]->nom .'</h3>';
					echo'<p class="title"> Par : '.$list[$x]->auteur .'</p>';
					echo'<p>Prep Time : ' . $list[$x]->temps .'</p>';
				
				
					for($i = 0; $i < 5; $i++)
					{
						if($i < $list[$x]->note)
							echo'<span class="fa fa-star checked"></span>';
						else
							echo'<span class="fa fa-star"></span>';
					}
					echo'('. $list[$x]->note .')';
				
				
					echo'<p><a href="recetteDetails.php?id=' . $list[$x]->id .'" class="button" style="color:white;">Voir la recette</a></p>';
					echo'</div>';
				}
			}
		}
		
		else if(isset($_GET['auteur']))
		{
			$auteur = $_GET['auteur'];
			$Recette = new Recette;
			$list = $Recette->getListRecetteAuteur($auteur);
			$count = sizeof($list);
			for($x = 0; $x < $count; $x++)
			{
				if(isset($list[$x]))
				{
					echo'<div class="card" id="a' . $x .'">';
					echo'<img src="'. $list[$x]->image .'" alt="Default" style="width:100%; height:250px">';
					echo'<h3>' . $list[$x]->categorie . ' <br> ' . $list[$x]->nom .'</h3>';
					echo'<p class="title"> Par : '.$list[$x]->auteur .'</p>';
					echo'<p>Prep Time : ' . $list[$x]->temps .'</p>';
				
				
					for($i = 0; $i < 5; $i++)
					{
						if($i < $list[$x]->note)
							echo'<span class="fa fa-star checked"></span>';
						else
							echo'<span class="fa fa-star"></span>';
					}
					echo'('. $list[$x]->note .')';
				
				
					echo'<p><a href="recetteDetails.php?id=' . $list[$x]->id .'" class="button" style="color:white;">Voir la recette</a></p>';
					echo'</div>';
				}
			}
		}
		
		else if(isset($_GET['nom']))
		{
			$nom = $_GET['nom'];
			$Recette = new Recette;
			$list = $Recette->getListRecetteNom($nom);
			$count = sizeof($list);
			for($x = 0; $x < $count; $x++)
			{
				if(isset($list[$x]))
				{
					echo'<div class="card" id="a' . $x .'">';
					echo'<img src="'. $list[$x]->image .'" alt="Default" style="width:100%; height:250px">';
					echo'<h3>' . $list[$x]->categorie . ' <br> ' . $list[$x]->nom .'</h3>';
					echo'<p class="title"> Par : '.$list[$x]->auteur .'</p>';
					echo'<p>Prep Time : ' . $list[$x]->temps .'</p>';
				
				
					for($i = 0; $i < 5; $i++)
					{
						if($i < $list[$x]->note)
							echo'<span class="fa fa-star checked"></span>';
						else
							echo'<span class="fa fa-star"></span>';
					}
					echo'('. $list[$x]->note .')';
				
				
					echo'<p><a href="recetteDetails.php?id=' . $list[$x]->id .'" class="button" style="color:white;">Voir la recette</a></p>';
					echo'</div>';
				}
			}
		}
		
		?>
		</div>
</body>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("listBG").style.marginLeft = "275px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("listBG").style.marginLeft = "125px";
}
</script>
<script>
//Get the button:
mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
</script>