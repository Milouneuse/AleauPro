<!DOCTYPE>

<?php session_start(); ?>
<html>
<head>
	<title>Index</title>
	<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
	<div id="navbar" class="navbar">
		<!-- notification message -->
		<?php 
			include "NavBar.php";
			echo '</div>';

		?>
	
<div class="video" style="min-width:'100%'; min-height:'100%';">
<video autoplay muted loop width="100%" height="contain">
  <source src="video/videoplayback_Trim.mp4" type="video/mp4" >
</video>
		<div class="center" id="menu"> <h4>Nous croyons que les petites choses comptent</h4> 
<?php 
$estConnecter = isset($_SESSION['username']);
$estAdmin = isset($_SESSION['admin']);
$estEntraineur = isset($_SESSION['entraineur']);
$estMembre = isset($_SESSION['membre']);
?>
<?php
  if(isset($_SESSION["success"])){
    echo '<text>' .$_SESSION["success"] . '</text>';}
    else
    echo"<text>Bienvenue sur le site de AleauPro, le site d'entraînement par excellence.</text>";
	
	
	
?>
		
		<div class="buttonInformation">
<?php
    if(!$estConnecter){
      echo"<a href='#info'> Services </a>";
      echo"<a href='Login/login.php'> Connection </a>";
      echo"<a href='Login/register.php'> Inscription </a>";
     }
?>
		<a href="Recettes.php"> Recettes </a>
		<a href="entraineur.php"> Entraîneurs </a>
    <a href="mailto:aleaupro.help@gmail.com"> Contacter </a>
    
    <?php

     if($estConnecter) {
      echo"<a href='Login/modifier.php'>Modifier vos informations</a>";
      echo"<a href='statistique.php'>Statistiques</a>";
      echo"<a href='plans.php'>Vos plans</a>";
      echo"<a href='abonnement.php'>Devenir membre</a>";
      echo"<a href='forum.php'>Forum</a>";
      echo"<a href='Login/logout.php'>Déconnection</a>";
       }
       if($estAdmin)
       {
        echo"<a href='#'>Panneau de configuration</a>";
       }
       if($estEntraineur)
       {
        echo"<a href='#'>Statistiques</a>";
       }
       
       ?>
		</div>
		</div>
		
</div>
<div class="container-info"> 
<div class="info">
	 Prenez votre corps en main
<br>
	 <p> Dans le coin droit, les bienfaits : vous gagnerez en force, vous dormirez mieux, vous préviendrez des problèmes de santé comme l'ostéoporose et les maladies du cœur et, si tel est votre objectif, vos jeans favoris continueront de vous faire pour les dix prochaines années. </p>
  </div>
  <div class="buttonInformation"> 
   <div> 
   <img src="image/icon/icon1.PNG">
      <h5> Mange des légumes </h5>
      <text> Les légumes sont pleins de vitamines, de minéraux, d'antioxydants et de fibres, les fruits et les légumes constituent une assurance santé à long terme. Ils présentent aussi l'avantage de contenir peu de matières grasses, tout en débordant de goûts et de saveurs! </text>
  </div>
  <div> 
   <img src="image/icon/icon2.PNG">
      <h5> Va au gym </h5>
      <text> Faire du sport en salle permet aussi de nouer facilement des relations. En effet, en ayant vos habitudes, il est possible de rencontrer des personnes qui, comme vous, sont venues là pour se plonger dans l'effort physique. </text>
  </div>
  <div> 
   <img src="image/icon/icon3.PNG">
      <h5> Soie en forme </h5>
      <text> Être actif quotidiennement permet de se sentir en forme plus longtemps et de garder une meilleure vitalité d'esprit. De plus, il est incontestable que l'activité physique est un facteur important dans la prévention de plusieurs maladies, dont la maladie coronarienne. </text>
  </div>
    </div>
  </div>

  <div class="container-info" style="background-image: url('image/bg_2.jpg');" data-stellar-background-ratio="0.5"> 
  <div class="infoIMG">  
  <h1> Obtenez les résultats souhaités</h1>
  <text> Pour brûler un maximum de calories, brûler vos graisses, et prendre du muscle, vous devez absolument faire des mouvements qui intègrent un maximum de muscles, pas des machines </text>
    </div>
    </div>
    <div class="container-info"> 
    <div class="info">
      Recettes
      <p> Voici quelques créations venant tout droit de notre livre de recettes. Celles-ci vous permettront de savourer les saveurs de la vie, tout en prenant soin de votre corps. </p>
      <div class="recetteInformation" style="padding-bottom:10%;"> 
        <div class="carte">
          <div class="image" style="background-image: url('image/img_1.jpg'); background-size:cover;"> </div>
        <div class="title"> Burger </div>
          <div class="description"> Par Justin, 30 min </div>
    </div>
    <div class="carte">
          <div class="image" style="background-image: url('image/img_1.jpg');"> </div>
        <div class="title"> Poisson </div>
          <div class="description"> Par Justin, 30 min </div>
    </div>
    <div class="carte">
          <div class="image" style="background-image: url('image/img_1.jpg'); background-size:cover;"> </div>
        <div class="title"> Wow </div>
          <div class="description"> Par Justin, 30 min </div>
    </div>
    <div class="carte">
          <div class="image" style="background-image: url('image/img_1.jpg'); background-size:cover;"> </div>
        <div class="title"> Miam </div>
          <div class="description"> Par Justin, 30 min </div>
    </div>
    </div>

    <div class="container-info" style="background-image: url('image/bg_3.jpg');" data-stellar-background-ratio="0.5"> 
  <div class="infoIMG">  
  <h1> Chaque étape compte </h1>
  <text> La persévérance, c'est ce qui rend l'impossible possible, le possible probable et le probable réalisé. </text>
    </div>
    </div>
    </div>
    </div>
    <div class="container-info"> 
    <div class="info" id="info">
    Services
    <p> Voici tous les services offerts par AleauPro </p>
    </div>
    <div class="buttonInformation"> 
   <div> 
   <img src="image/icon/icon1.PNG">
      <h5> Fabrication de plan d'entraînement </h5>
      <text> Un outil très facile d’utilisation qui permet de créer un plan d’entraînement. Les membres peuvent partager leurs plans d’entraînement avec d’autres membres. </text>
  </div>
  <div> 
   <img src="image/icon/telephone.png">
      <h5> Une application mobile </h5>
      <text> L’application mobile permet aux utilisateurs du site d’utiliser toutes les fonctions que AleauPro peut offrir de façon optimale. </text>
  </div>
  <div> 
   <img src="image/icon/forum.png">
      <h5> Forum motivant </h5>
      <text> Ce forum a l'objectif de vous aider à atteindre votre objectif. En effet, vous pouvez y retrouver plein d'astuces et de conseils. La communauté de AleauPro va vous aider à trouver la motivation. </text>
  </div>
  <div> 
   <img src="image/icon/recette.png">
      <h5> Le livre de recettes </h5>
      <text> Notre livre de recettes est l'outil que vous devez posséder pour atteindre vos objectifs. En effet, notre livre de recettes possède une grande variété de recettes qui sont aussi bonnes au goût que pour la santé. </text>
  </div>
  <div> 
   <img src="image/icon/trainer.png">
      <h5> Entraîneur prêt à vous aider </h5>
      <text> Plusieurs entraîneurs diplômés sont prêts à répondre à vos questions. De plus, ils confectionnent des plans qui sont disponibles pour tous les membres du site. </text>
  </div>
  <div> 
   <img src="image/icon/partenariat.png">
      <h5> Partenariat avec des entraîneurs qualifiés </h5>
      <text> Vous êtes un entraîneur et que vous désirez générer un surplus d'argent facilement tout en aidant la communauté de AleauPro. Vous pouvez alors devenir un partenaire en cliquant <a href="formulaireEntraineur.php"> ici </a></text>
  </div>
    </div>
    <div class="container-info"> 
    <div class="info" id="info">
    L'équipe
    <p> Voici tous les développeurs de AleauPro </p>
    </div>
    <div class="buttonInformation"> 
   <div> 
   <img id="photo" src="image/DSC01303.jpg">
      <h5> Laurent Généreux </h5>
      <text> Un jeune homme plein de talent qui tente de faire une application web à l'aide de languages tel que javascript, php, html et css. </text>
      <br>
      <text> Email : lau.g@live.ca </text>
  </div>
  
  <div> 
  <img id="photo" src="image/leproaveclesgains.PNG">
      <h5> Alexandre Arseneault </h5>
      <text> Depuis le début de AleauPro, il montre qu'il est à la hauteur du métier programmeur. Il a eu des hauts et des bas, mais il a toujours été la pour les membres de son équipe. </text>
      <br>
      <text> Email : alexandre.arseneault99@gmail.com </text>
  </div>
  <div> 
  <img id="photo" src="image/20200911_154242.jpg">
      <h5> Louis-Philippe Macedo </h5>
      <text> C'est l'homme de la situation lorsqu'il s'agit d'un forum. Après au moins 10,000 heures sur reddit, les forums n'ont pas de secret pour ce jeune homme. </text>
      <br>
      <text>Email : louispm2@gmail.com </text>
  </div>
    </div>
	<script>
		window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("navbar").style.top = "0";
  } else {
    document.getElementById("navbar").style.top = "-80px";
  }
}
		</script>

</body>
</html>