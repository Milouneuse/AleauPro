<!DOCTYPE>

<?php include "Classes/Entraineurs/Entraineurs.php"; ?>
<?php include "Classes/Utilisateurs/Clients.php"; ?>
<?php session_start(); ?>
<html>
<head>
	<title>Entraineur</title>
    <link rel="stylesheet" type="text/css" href="css.css">
</head>
<?php 
$id = $_GET['id'];
$Entraineur = new Entraineurs;
$Clients = new Clients;
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
	<div class="container-info" style="padding-right:20%; padding-left:20%;">
		<div class="info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
		<img src="image/<?php echo $list->img ?>.jpg" alt="Massud">
		<h1 style="font-size: 1.5rem;">
		<?php 
		echo $list->prenom . ' ';
		echo $list->nom; 
		?>
		</h1>
		<p>
			Entraîneur Certifié
		</p>
		<script>
			function info(){
				document.getElementById('info').style.display = 'initial';
				document.getElementById('abonneeGrid').style.display = 'none';
				document.getElementById('commentaireGrid').style.display = 'none';
				document.getElementById('buttonPlan').classList.remove('selected');
				document.getElementById('buttonInfo').classList.add('selected');
				document.getElementById('buttonCommentaire').classList.remove('selected');
				document.getElementById('buttonAbonnee').classList.remove('selected');
			}
			function plan(){
				document.getElementById('info').style.display = 'none';
				document.getElementById('abonneeGrid').style.display = 'none';
				document.getElementById('commentaireGrid').style.display = 'none';
				document.getElementById('buttonPlan').classList.add('selected');
				document.getElementById('buttonInfo').classList.remove('selected');
				document.getElementById('buttonCommentaire').classList.remove('selected');
				document.getElementById('buttonAbonnee').classList.remove('selected');
			}
			function commentaire(){
				document.getElementById('commentaireGrid').style.display = 'initial';
				document.getElementById('info').style.display = 'none';
				document.getElementById('abonneeGrid').style.display = 'none';
				document.getElementById('buttonCommentaire').classList.add('selected');
				document.getElementById('buttonInfo').classList.remove('selected');
				document.getElementById('buttonPlan').classList.remove('selected');
				document.getElementById('buttonAbonnee').classList.remove('selected');
			}
			function abonee(){
				document.getElementById('abonneeGrid').style.display = 'initial';
				document.getElementById('info').style.display = 'none';
				document.getElementById('commentaireGrid').style.display = 'none';
				document.getElementById('buttonAbonnee').classList.add('selected');
				document.getElementById('buttonInfo').classList.remove('selected');
				document.getElementById('buttonPlan').classList.remove('selected');
				document.getElementById('buttonCommentaire').classList.remove('selected');
			}
		</script>
		<div class="informationGrid">
			<div class="buttonInformationTrainer">
				<button class="selected" onclick="info()" id="buttonInfo"> Information </button>
				<button onclick="plan()" id="buttonPlan"> Plan </button>
				<button onclick="commentaire()" id="buttonCommentaire"> Commentaire </button>
				<button onclick="abonee()" id="buttonAbonnee"> Follower </button>
			</div>
			<?php 
			if(isset($_SESSION["username"])){
				$userid = $_SESSION["id"];
				$ent = new Entraineurs;
				$isfollowing = $ent->getFollow($userid,$id);
				if($isfollowing){
					echo "<div class='buttonInformationTrainer' style='padding-left:50%;'>";
					echo "<form method='post' action='forms/processEntraineur.php' style='margin: 0; padding: 0; border: none;background-color: #FFFFFF;'>";
					echo "<div class='input-group' style='margin:0;'>";
					echo "<input name='userid' id='userid' type='hidden' value='$userid'/>";
					echo "<input name='entraineurid' id='entraineurid' type='hidden' value='$id'/>";
					echo "<input name='switch' id='switch' type='hidden' value='unfollow'/>";
					echo "<button type='submit' style=''>Unfollow</button>";
					echo "</div>";
					echo "</form>";
					echo "<button> Chat </button>";
					echo "</div>";
				}
				else{
				echo "<div class='buttonInformationTrainer' style='padding-left:50%;'>";

				echo "<form method='post' action='forms/processEntraineur.php' style='margin: 0; padding: 0; border: none;background-color: #FFFFFF;'>";
				echo "<div class='input-group' style='margin:0;'>";
				echo "<input name='userid' id='userid' type='hidden' value='$userid'/>";
				echo "<input name='entraineurid' id='entraineurid' type='hidden' value='$id'/>";
				echo "<input name='switch' id='switch' type='hidden' value='follow'/>";
				echo "<button type='submit' style=''>Follow</button>";
				echo "</div>";
				echo "</form>";
				echo "<button> Chat </button>";
				echo "</div>";
				}
			}
			
			
			?>
			
		</div>

		<div class="informationGrid">
			<div id="info"> 
				<text> Travail : <?php echo $list->travail; ?> </text>
				<br>
				<text> École : <?php echo $list->ecole; ?> </text>
				<br>
				<text> Sexe : <?php echo $list->sexe; ?> </text>
				<br>
				<text> Cote : <?php
				for($i = 0; $i < 5; $i++)
				{
					 if($i < $list->note && isset($list->note))
				echo'<span class="fa fa-star checked"></span>';
					 else
				echo'<span class="fa fa-star"></span>';
				}
				?> </text>
				</div>
		 </div>
		 <div id="commentaireGrid" style="display:none;"> 
				<?php include "view/commentaireview.php"; ?>
			</div>

			<div id="abonneeGrid" style="display:none;"> 
				<?php include "view/abonneeview.php"; ?>
			</div>
		
		</div>
		</div>