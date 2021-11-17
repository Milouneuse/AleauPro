<!DOCTYPE>
<?php include "Classes/Entraineurs/Entraineurs.php"; ?>
<?php session_start(); ?>
<html>
<head>
	<title>Entraineur</title>
    <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
	<div id="navbar" class="navbar onload" style="top: 0px;">
		<!-- notification message -->
		<?php 
			include "NavBar.php";
			echo '</div>';

		?>
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
		<!-- logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>
			<!-- <p>Welcome <strong><?php // echo $_SESSION['username']; ?></strong></p>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p> -->
		<?php endif ?>
    </div>
    <div class="container-info">
        <div class="info">
            Liste des entraîneurs certifiés
            <p> Tous les entraîneurs ci-dessous sont certifiés et qualifiés. Ils possèdent tous un cours à l'université ou l'équivalent. Pour devenir un entraîneur et aider la communauté de AleauPro <a href="formulaireEntraineur.php"> clique ici </a></p>
        </div>
        <div class="buttonInformation" style="padding-left:20%; padding-right:20%;">
        <a href="#perte" style="color:black; border:2px solid black;"> Perte de poids </a>
        <a href="#prise" style="color:black; border:2px solid black;"> Prise de masses </a>
        <a href="#garde" style="color:black; border:2px solid black;"> Garder la forme </a>
        </div>
        <div class="info">
            <p> Quels sont vos objectifs ? C'est la question que vous devez vous poser avant de vous lancer dans l'entraînement. Visualiser vos objectifs finale va vous permettre d'avoir la motivation pour atteindre votre but ultime. </p>
            </div>
            <div class="container-info" style="background-image: url('image/bg_1.jpg');" data-stellar-background-ratio="0.5"> 
  <div class="infoIMG">  
  <h1> Perte de poids</h1>
  <text> La perte de poids est un art à maîtriser. Il faut bien manger, faire du sport et avoir beaucoup de motivation.  </text>
    </div>
    </div>
    <div class="info" style="padding-top:5%;" id="perte">
            Perte de poids
            <p> Voici les entraîneurs qui sont spécialisés dans le domaine de la perte de poids. Vous pouvez visité leur profil pour regarder leur méthode de travail et leur niveau de professionalisme. </p>
        </div>
        <div class="cardContainer">
        <?php 
        $Entraineur = new Entraineurs;
        $listPerte = $Entraineur->getListCoach(1);

        for($x = 0; $x < 3; $x++)
        {
             if(isset($listPerte[$x]))
             {
          echo'<div class="card" id="a' . $x .'">';
          echo'<img style="max-width:300px; height:300px;" src="image/' . $listPerte[$x]->img . '.jpg" alt="Default" style="width:100%">';
          echo'<h3>' . $listPerte[$x]->prenom . ' <br> ' . $listPerte[$x]->nom .'</h3>';
          echo'<p class="title">'.$listPerte[$x]->travail .'</p>';
          echo'<p>' . $listPerte[$x]->ecole .'</p>';
          for($i = 0; $i < 5; $i++)
          {
               if($i < $listPerte[$x]->note && isset($listPerte[$x]->note))
          echo'<span class="fa fa-star checked"></span>';
               else
          echo'<span class="fa fa-star"></span>';
          }
          echo'<p><a href="entraineurProfil.php?id=' . $listPerte[$x]->id . '" class="button" style="color:white;">Voir le profil</a></p>';
          echo'</div>';
     }

        } 
        ?>
    
    </div>
    <div class="container-info" style="background-image: url('image/bg_4.jpg');" data-stellar-background-ratio="0.5"> 
  <div class="infoIMG">  
  <h1> Prise de masses</h1>
  <text> Pour prendre de la masse, le principe consiste à avoir une alimentation légèrement hypercalorique pendant quelques mois (2 à 4 mois). L'apport de protéines est augmenté ainsi que l'apport en glucides pour que l'organisme dispose de tous les nutriments nécessaires pour la construction musculaire. </text>
    </div>
    </div>
    <div class="info" style="padding-top:5%;" id="prise">
            Prise de masses
            <p> Voici les entraîneurs qui sont spécialisés dans le domaine de la prise de masses. Vous pouvez visité leur profil pour regarder leur méthode de travail et leur niveau de professionalisme. </p>
        </div>
        <div class="cardContainer">
    <?php 
        $Entraineur = new Entraineurs;
        $listGain = $Entraineur->getListCoach(2);

        for($x = 0; $x < 3; $x++)
        {
             if(isset($listGain[$x]))
             {
          echo'<div class="card" id="a' . $x .'">';
          echo'<img style="max-width:300px; height:300px;" src="image/' . $listGain[$x]->img . '.jpg" alt="Default" style="width:100%">';
          echo'<h3>' . $listGain[$x]->prenom . ' <br> ' . $listGain[$x]->nom .'</h3>';
          echo'<p class="title">'.$listGain[$x]->travail .'</p>';
          echo'<p>' . $listGain[$x]->ecole .'</p>';
          for($i = 0; $i < 5; $i++)
          {
               if($i < $listGain[$x]->note)
          echo'<span class="fa fa-star checked"></span>';
               else
          echo'<span class="fa fa-star"></span>';
          }
          echo'<p><a href="entraineurProfil.php?id=' . $listGain[$x]->id .'" class="button" style="color:white;">Voir le profil</a></p>';
          echo'</div>';
     }

        } 
        ?>
    </div>
    <div class="container-info" style="background-image: url('image/bg_5.jpg');" data-stellar-background-ratio="0.5"> 
  <div class="infoIMG">  
  <h1> Garder la forme</h1>
  <text> L'activité physique joue un rôle essentiel par rapport à votre santé, à votre bien-être et à votre qualité de vie. Améliorez votre santé en intégrant l'activité physique à un mode de vie sain. Soyez actif au moins 2 heures et demie par semaine pour en retirer des bienfaits pour la santé. </text>
    </div>
    </div>
    <div class="info" style="padding-top:5%;" id="garde">
    Garder la forme
            <p> Voici les entraîneurs qui sont spécialisés dans le domaine de la garder la forme. Vous pouvez visité leur profil pour regarder leur méthode de travail et leur niveau de professionalisme. </p>
        </div>
        <div class="cardContainer">
        <?php 
        $Entraineur = new Entraineurs;
        $listStay = $Entraineur->getListCoach(3);

        for($x = 0; $x < 3; $x++)
        {
          if(isset($listStay[$x]))
          {
          echo'<div class="card" id="a' . $x .'">';
          echo'<img style="max-width:300px; height:300px;" src="image/' . $listStay[$x]->img . '.jpg" alt="Default" style="width:100%">';
          echo'<h3>' . $listStay[$x]->prenom . ' <br> ' . $listStay[$x]->nom .'</h3>';
          echo'<p class="title">'.$listStay[$x]->travail .'</p>';
          echo'<p>' . $listStay[$x]->ecole .'</p>';
          for($i = 0; $i < 5; $i++)
          {
               if($i < $listStay[$x]->note)
          echo'<span class="fa fa-star checked"></span>';
               else
          echo'<span class="fa fa-star"></span>';
          }
          echo'<p><a href="entraineurProfil.php?id=' . $listStay[$x]->id .'" class="button" style="color:white;">Voir le profil</a></p>';
          echo'</div>';
     }

        } 
        ?>

    
        </div>
    </div>
        </div>
    </div>
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
    