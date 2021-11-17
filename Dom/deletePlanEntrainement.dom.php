<?php 
include "../Classes/PlanEntrainement/PlanEntrainement.php";
session_start();
if(!isset($_SESSION["id"]))
header("location: Login/login.php");

$planEntrainement = new PlanEntrainement;
$planInfo = $planEntrainement->getPlanByPlanId($_GET["planId"]);
if($planInfo[0]->idClient != $_SESSION["id"])
  header("location: plan.php");

$planInfo[0]->deletePlan($_GET["planId"]);

header("location: ../plans.php");
?>