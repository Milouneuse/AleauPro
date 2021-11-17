<?php
    include  "/home/Aleaupro2020/public_html/Classes/Thread/thread.php";
    //include  "/home/Aleaupro2020/public_html/Classes/Posts/Post.php";

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
      case 'lock':
        lock();
      break;
      case 'pin':
        pin();
      break;
    }


    function create(){
      $title = $_POST["titre"];
       //modification du post pour ajouter description
      $description = $_POST["texte"];
      $authorID = $_SESSION["id"];
      $catID = $_POST["categorie"];
      $announcement = $_POST["announcement"];
      $locked = $_POST["locked"];
      $date = date('Y-m-d H:i:s');
    
    
      if(empty("$title")){
        //header("Location: ../error.php?ErrorMSG=bad%20request!1");
        die();
      }
      if(empty("$description")){
        //header("Location: ../error.php?ErrorMSG=bad%20request!2");
        die();
      }
    
      $thread = new thread();
      if(!$thread->add_thread($title,$authorID, $description, $catID, $locked, $announcement, $date)){
         //header("Location: ../error.php?ErrorMSG=Bad%20request!3");
        die();
      }
      header("Location: ../forum.php");
      die();
    }

    function edit(){
      $title = $_POST["titre"];
      $description = $_POST["texte"];
      $catID = $_POST["categorie"];
      $id = $_POST["id"];
      $name = $_POST["name"];
      if(empty("$title")){
        //header("Location: ../error.php?ErrorMSG=bad%20request!1");
        die();
      }
      if(empty("$description")){
        //header("Location: ../error.php?ErrorMSG=bad%20request!2");
        die();
      }
      $thread = new thread();
      $thread->update($id, $title, $description, $catID);
      
      
      
      
      header("Location: ../forum.php");
      die();
    }

    function delete(){
      $id = $_POST["id"];
      $thread = new thread();
      $thread->delete($id);
      $post = new Post();
      $post->deletethread($id);
      header("Location: ../forum.php");
      die();
    }

    function lock(){
      $id = $_POST["id"];
      $lock = $_POST["lock"];
      $thread = new thread();
      if($lock == 1){
        $thread->updatelock($id, 0);
      }
      else{
        $thread->updatelock($id, 1);
      }      
      header("Location: ../forum.php");
      die();
    }

    function pin(){
      $id = $_POST["id"];
      $pin = $_POST["pin"];
      $thread = new thread();
      if($pin == 1){
        $thread->updatepin($id, 0);
      }
      else{
        $thread->updatepin($id, 1);
      }      
      header("Location: ../forum.php");
      die();
    }
    

    
    

?>
