  <head>
  <?php 
  session_start();
  include "Classes/PlanEntrainement/PlanEntrainement.php";
  $planEntrainement = new PlanEntrainement;
  $planInfo = $planEntrainement->getPlanByPlanId($_GET["planId"]);
  if($planInfo[0]->idClient != $_SESSION["id"])
  header("location: plan.php");
  ?>
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
  <!-- Modal content -->
  <div class="modal-content" style="width:100%; padding-top:3%;">
    <div class="modal-header">
      <h2>AleauPro</h2>
    </div>
    <div class="modal-body">
    <form id="regForm">
    <?php   foreach($planInfo as $item){ ?>
  <h1> <?php echo $item->nom; ?> </h1>
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    Description : 
    <p>
    <?php  
    if(isset($item->bio) && strlen($item->bio) != 0)
    echo $item->bio;
    else
    echo 'Aucune description';

  }
    ?>
    </p>
    Objectif de l'entrainement :
    <p>
    <?php 
      if(isset($item->objectif))
      {
        if($item->objectif == "perte")
        echo "Perte de poids";
        else if($item->objectif == "gain")
        echo "Gagner du poids";
        else if($item->objectif == "santer")
        echo "Garder la forme";
      }
      else
      echo 'Aucun ojectif';
    ?>
    </p>
    Nombre de jours :
    <p>
      <?php if(isset($item->nbJours))
              echo $item->nbJours;
      ?>
      journées
    </p>
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
    <button type="button" id="returnBtn" onclick="location.href='plans.php'">Retour</button>
    <button type="button" id="deleteBtn" onclick="location.href='Dom/deletePlanEntrainement.dom.php?planId=<?php echo $_GET['planId']; ?>'">Effacer</button>
    </div>
  </div>
  <?php include "Classes/ExercicePlans/ExercicePlan.php";
  include "Classes/Exercises/Exercice.php";
      $exercicePlan = new ExercicePlan;
      $exercice = new Exercice;
     
  ?>
  <div class="container-info"> 
  <?php for($i = 1; $i <= $item->nbJours; ++$i){
     $exerciceInfo = $exercicePlan->getAllExerciceDay($_GET["planId"], $i);
    ?> 
        
        <div class="info">
	           Journée <?php echo $i; ?>
        </div>
        <div class="buttonInformation"> 
    <?php
     foreach($exerciceInfo as $value)
    {
    ?>
   <div> 
   <img src="image/ProfilePicDefault.jpg">
      <h5> <?php
      $exerciceName = $exercice->getNameExerciceById($value->exerciceId);
      echo $exerciceName[0]->ExerciceNom; ?> </h5>
      <text> 
      Nombre de série : <?php echo $value->nbSerie; ?>
      <br>
      Nombre de répétition : <?php echo $value->nbRep; ?>
      <br>
      Nombre de poids : <?php echo $value->poids; ?>
      </text>
    </div>
    <?php
  }  ?>
    </div>
    <?php
  }  ?>
    </div>
</form>
    </div>
  </div>
    </body>
  <script>

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Créer";
  } else {
    document.getElementById("nextBtn").innerHTML = "Continuer";
  }
}


</script>

