<!DOCTYPE>

<?php include "Classes/Recette/Recette.php"; ?>
<html>
<head>
	<title>Dejeuner</title>
    <link rel="stylesheet" type="text/css" href="css.css">
</head>
<?php 
$Recette = new Recette;
$list = $Entraineur->getByID($id);
?>
<body>
	<div id="navbar" class="navbar onload" style="top: 0px;">
		<!-- notification message -->
		<?php 
			include "NavBar.php";
			echo '</div>';

		?>
	</div>
		<?php 
		echo $list->id . ' ';
		echo $list->nom; 
		?>