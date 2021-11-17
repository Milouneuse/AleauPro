<?php
include "Classes/PlanEntrainement/PlanEntrainement.php";
session_start();
if(!isset($_SESSION["username"]))  
    header("location: Login/login.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $name = $_POST['fname'];
  $bio = $_POST['bio'];
  $objectif = $_POST['objectif'];
  $jours = $_POST['jours'];
  $planEntrainement = new PlanEntrainement;
  $planEntrainement->ajouterPlanEntrainement($name, $bio, $objectif, $jours, $_SESSION["id"]); 
  $compteur = 0;
    for($i = 0; $i < $jours; ++$i){
      while(isset($_POST['nbSeriejours' . $i . 'Exercice' . $compteur])){
      $nbSerie = $_POST['nbSeriejours' . $i . 'Exercice' . $compteur];
      $nbRep = $_POST['nbRepjours' . $i . 'Exercice' . $compteur];
      $nomExercice = $_POST['NomExercicejours' . $i . 'Exercice' . $compteur];
      $poids = $_POST['nbPoidsjours' . $i . 'Exercice' . $compteur];
      $exerciceId = $planEntrainement->getIdExercice($nomExercice);
      $planId = $planEntrainement->getIdPlan();
      $j = $i + 1;
      $planEntrainement->ajouterExercicePlan($planId, $j, $nbSerie, $nbRep, $exerciceId, $poids);
      ++$compteur;
  }
  $compteur = 0;
  }
}
header("location: plans.php");
?>