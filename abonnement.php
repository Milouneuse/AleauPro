<!DOCTYPE>
<?php include "Classes/Entraineurs/Entraineurs.php"; ?>
<?php session_start(); ?>
<html>
<head>
	<title>Abonnement</title>
	
    <link rel="stylesheet" type="text/css" href="css.css">
</head>
<script>

</script>
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
        <div class="info infoAnim">
            Comparaison des abonnements
			<p>Comparez notre gamme d'abonnements vous offrant des périodes différentes afin de vous fixer un temps pour accomplir vos objectifs.</p>
		</div>
		<div class="aboComp" id="transi1">
			<div class="aboContainer aboFirst" id="aboHaut1">
				<div class="aboTitre">
					LE DÉBUTANT
				</div>
				<div class="aboInfo">
					Accès Membre 30 jours<br>
					Intéraction avec entraîneurs<br>
					Abonnement le moins cher<br>
					Accès aux récompenses<br>
					etc.
				</div>
				<button class="aboBtn" onclick="window.location.href='payer.php?amount=10'">
					30 JOURS (10$)
				</button>
			</div>	
			
			<div class="aboContainer" id="aboHaut2">
				<div class="aboTitre">
					LE MÉDIAN
				</div>
				<div class="aboInfo">
					Accès Membre 180 jours<br>
					Intéraction avec entraîneurs<br>
					Abonnement le moins cher<br>
					Accès aux récompenses<br>
					etc.
				</div>
				<button class="aboBtn" onclick="window.location.href='payer.php?amount=50'">
					180 JOURS (50$)
				</button>
			</div>	
			
			<div class="aboContainer aboLast" id="aboHaut3">
				<div class="aboTitre">
					L'AVANCÉ
				</div>
				<div class="aboInfo">
					Accès Membre 360 jours<br>
					Intéraction avec entraîneurs<br>
					Abonnement le moins cher<br>
					Accès aux récompenses<br>
					etc.
				</div>
				<button class="aboBtn" onclick="window.location.href='payer.php?amount=95'">
					365 JOURS (95$)
				</button>
			</div>	
		</div>
				<!--<button onclick="myFunction()">Toggle dark mode</button>-->
        <div class="info littlePad">
			Pourquoi s'abonner ?
			<p>Un abonnement PRO vous permet d'intéragir avec des entraîneurs vérifiés et certifiés. Les entraîneurs PRO sont là pour vous aider, vous motiver et vous soutenir dans l'atteinte de vos objectifs. Vous avez des questions, ils ont des réponses... Les entraîneurs certifiés ALAUPRO offrent un service à la clientèle excellent. De plus, le coût moyen d'un entraîneur par heure est d'environ 60$, l'abonnement ici, vise à offrir aux membres, l'accès à des entraîneurs qualifiés pour un coût moindre.</p>
        </div>
		</div>
		<div class="videPad vp"></div>
        <?php 
        $Entraineur = new Entraineurs;
        $listPerte = $Entraineur->getListCoach(1);

        for($x = 0; $x < 3; $x++)
        {
             if(isset($listPerte[$x]))
             {
				echo'<div id="cardContainerAbo" class="cardContainerAbo'.$x.'">';
					echo'<div class="cardAbo coach'.$x.'" id="a' . $x .'">';
						echo'<img src="image/ProfilePicDefault.jpg" alt="Default" style="width:100%">';
						echo'<h3>' . $listPerte[$x]->prenom . ' <br> ' . $listPerte[$x]->nom .'</h3>';
						echo'<p class="title">'.$listPerte[$x]->travail .'</p>';
						echo'<p>' . $listPerte[$x]->ecole .'</p>';
						for($i = 0; $i < 5; $i++)
						{
							if($i < $listPerte[$x]->note)
								echo'<span class="fa fa-star checked"></span>';
							else
								echo'<span class="fa fa-star"></span>';
						}
						echo'<p><a href="entraineurProfil.php?id=' . $listPerte[$x]->id . '" class="button" style="color:white;">Voir le profil</a></p>';
					echo'</div>';
					echo'<div id="descAbo"class="cardAboDes'.$x.'">'.$listPerte[$x]->bio.'</div>';
			echo'</div>';
			echo'<div class="videPad vp'.$x.'"></div>';
			}

        } 
        ?>
    

		<div class="container-info" style="background-image: url('image/bg_4.jpg');" data-stellar-background-ratio="0.5"> 
			<div class="infoIMG">  
				<h1> Motivation</h1>
				<text> Système de récompenses, tracking de la progression </text>
			</div>
		</div>
		 <div class="info littlePad">
			Votre Motivation
			<p class="textInf">AleauPro vise à vous garder motiver en vous offrant des points PRO pour chaque entrainement réalisé. Ces points sont ensuite convertis en $ de remise. Que ce soit pour votre prochain abonnement, un produit dans notre boutique, vous pouvez les appliquer partout sur notre plateforme. </p>
        </div>      
	  
	  
		<div class="container-info" style="background-image: url('image/bg_5.jpg');" data-stellar-background-ratio="0.5"> 
			<div class="infoIMG">  
				<h1>Utilitaire</h1>
				<text>Accès à des fonctionnalités supplémentaires et la cessation des annonces</text>
			</div>
		</div>
		<div class="info littlePad">
			Utilisation plus agréable
			<p class="textInf">Étant une plateforme gratuite, AleauPro offre toutes ses fonctionnalités à tous les membres. Avec un abonnement PRO, vous n'aurez plus de publicité et pourrez dorénavent sauvegarder une infinité de plan sur notre plateforme, à défaut d'un seul.</p>
        </div>      
    </div>
</div>
    </div>
</body>
<script>
	//Height -450 pour voir que le card au complet
function isInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight - 325|| document.documentElement.clientHeight - 325) &&
        rect.right <= (window.innerWidth|| document.documentElement.clientWidth)

    );
}

function addClassAnimation(obj) {
	obj.classList.add("animateOnScroll");
}
function addClassAnimationDescGauche(obj) {
	obj.classList.add("animateOnScrollDescGauche");
}
function addClassAnimationDescDroite(obj) {
	obj.classList.add("animateOnScrollDescDroite");
}
const c1done = 0;
const c2done = 0;
const c3done = 0;
const vp0 = document.querySelector('.vp');
const vp1 = document.querySelector('.vp0');
const vp2 = document.querySelector('.vp1');
const aboDes1 = document.querySelector('.cardAboDes0');
const aboDes2 = document.querySelector('.cardAboDes1');
const aboDes3 = document.querySelector('.cardAboDes2');
const coach1 = document.querySelector('.coach0');
const coach2 = document.querySelector('.coach1');
const coach3 = document.querySelector('.coach2');
const message = document.querySelector('#message');

document.addEventListener('scroll', function () {
    const messageText = isInViewport(vp0) ?
        'The box is visible in the viewport' :
        'The box is not visible in the viewport';

	if(isInViewport(vp0) && c1done == 0){
		addClassAnimation(coach1);
		addClassAnimationDescGauche(aboDes1);
		c1done = 1;
	}

	if(isInViewport(vp1) && c2done == 0){
		addClassAnimation(coach2);
		addClassAnimationDescDroite(aboDes2);
		c2done = 1;
	}

	if(isInViewport(vp2) && c3done == 0) {
		addClassAnimation(coach3);
		addClassAnimationDescGauche(aboDes3);
		c3done = 1;
	}
		console.log(messageText);
    //message.textContent = messageText;

}, {
    passive: true
});
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
<script>
function myFunction() {
   var element = document.body;
   element.classList.toggle("dark-mode");
}
</script>
    
    