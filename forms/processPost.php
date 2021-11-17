<?php
//include  "/home/Aleaupro2020/public_html/Classes/Posts/Post.php";
include  "/home/Aleaupro2020/public_html/Classes/Thread/thread.php";

session_start();

switch($_POST['switch']){
  case 'create':
    create();
  break;
  case 'edit':
    edit();
  break;
  case 'delete':
    delete();
  break;
}


function create(){
  $content = $_POST["texte"];
  $authorID = $_SESSION["id"];
  $threadid = $_POST["thread"];
  $date = date('Y-m-d H:i:s');


  if(empty("$content")){
      //header("Location: ../error.php?ErrorMSG=bad%20request!2");
      die();
    }


    $post = new Post();
    if(!$post->add_post($authorID,$content,$threadid,$date)){
        
      die();
    }
    $thread = new Thread();
    $thread->updateupdate($threadid,$date);


    header("Location: ../forum.php");
    die();
}

function edit(){
  $content = $_POST["texte"];
  $id = $_POST["id"];
  $post = new Post();
  $post->update($id,$content);
  header("Location: ../forum.php");
  die();
}

function delete(){
  $id = $_POST["id"];
  $post = new Post();
  $post->delete($id);
  header("Location: ../forum.php");
  die();
}



?>