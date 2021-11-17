<?php

include  "/home/Aleaupro2020/public_html/Classes/Entraineurs/Entraineurs.php";

session_start();

switch($_POST['switch']){
    case 'ecole':
      ecole();
    break;
    case 'travail':
      travail();
    break;
    case 'bio':
        bio();
    break;
    case 'follow':
      follow();
    break;
    case 'unfollow':
      unfollow();
    break;
  }

function ecole(){
    $id = $_SESSION["id"];
    $ecole = $_POST["ecolee"];
    $entraineur = new Entraineurs();
    $entraineur->updateecol($id,$ecole);
    header("Location: ../Login/modifier.php");
    die();
}

function travail(){
    $id = $_SESSION["id"];
    $travail = $_POST["travaill"];
    $entraineur = new Entraineurs();
    $entraineur->updatetravai($id,$travail);
    header("Location: ../Login/modifier.php");
    die();
}

function bio(){
    $id = $_SESSION["id"];
    $bio = $_POST["bioo"];
    $entraineur = new Entraineurs();
    $entraineur->updatebi($id,$bio);
    header("Location: ../Login/modifier.php");
    die();
}

function follow(){
  $userid = $_POST['userid'];
  $entraineurid = $_POST["entraineurid"];
  $entraineur = new Entraineurs();
  $entraineur->follow($userid, $entraineurid);
  header("Location: ../entraineurProfil.php?id=$entraineurid");
  die();
}
function unfollow(){
  $userid = $_POST['userid'];
  $entraineurid = $_POST["entraineurid"];
  $entraineur = new Entraineurs();
  $entraineur->unfollow($userid, $entraineurid);
  header("Location: ../entraineurProfil.php?id=$entraineurid");
  die();
}



?>