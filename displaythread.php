<?php
error_reporting(E_ALL ^ E_NOTICE);
  session_start();
  include "Classes/Thread/thread.php";

  if(!isset($_GET["threadID"])){
    header("Location: error.php?ErrorMSG=Bad%20Request!");
    die();
  }
  $id=$_GET["threadID"];
  $thread = Thread::load_thread_by_id($id);
  $title = $thread[1];
  $catid = $thread[2];
  $authorid = $thread[3];
  $text = $thread[4];
  $locked = $thread[5];
  $announcement = $thread[6];
  $date = $thread[7];
  $name = $_GET["author"];
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> forum </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
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
        <div class="container align-center text-center" style="padding-top: 5%">
        <div class="container mt-30">
            <div>
                <div style="text-align: center; font-weight: bold; padding-top: 5%; width: 90%">
                    <h1><?php echo "$title"?></h1>
                    <h3><?php echo "PAR $name"?></h3>
                    <h3><?php echo "Publié $date"?></h3>
                </div>
                <div style='padding-top: 25px; width: 90%; text-align: center;'>
                    <?php
                        echo "<div class='card-header' ><span style='white-space: pre-line;'>$text</span></div>";

                    ?>
                    <br>
                    <div name="options">
                        <?php
                            if($authorid == $_SESSION["id"]){
                                echo"<a href='#form' class='btn btn-default' data-toggle='collapse'>Modifier</a>";
                                echo "<div id='form' class='collapse'>";
                                echo"<form method='post' action='forms/processThread.php'>";
                                echo "<div class='input-group'>";
                                echo "<input name='id' id='id' type='hidden' value='$id'/>";
                                echo "<input name='switch' id='switch' type='hidden' value='edit'/>";
                                echo "<input name='name' id='name' type='hidden' value='$name'/>";
                                echo "<label>Titre</label>";
                                echo "<br>";
                                echo "<input type='text' id='titre' name='titre' value='$title'/><br>";
                                echo "</div>";
                                echo "<div class='input-group'>";
                                echo "<label>contenu</label>";
                                echo "<br>";
                                echo "<textarea name='texte' id='texte'>$text</textarea><br>";
                                echo "</div>";
                                echo "<div class='input-group'>";
                                echo "<label>catégorie</label>";
                                echo "<select name='categorie' id='categorie'>";
                                include "Classes/Categories/Categories.php";
                                $cat_list = Categories::getAll();
                                foreach($cat_list as $cat) {
                                    $cat->select_cat();
                                }
                                echo "</select>";
                                echo "</div>";
                                echo "<div class='input-group'>";
                                echo "<button type='submit'>Modifier</button>";
                                echo "</div>";
                                echo "</form>";
                                echo "</div>";
                                
                            }
                            if($_SESSION["admin"]){
                                $pin = "Retirer des annonces";
                                $lock = "Ouvrir les commentaires";
                                if($locked == 0){
                                    $lock = "Fermer les commentaires";
                                }
                                if($announcement == 0){
                                    $pin = "Mettre en annonce";
                                }
                                echo"<a href='#pin' class='btn btn-default' data-toggle='collapse'>$pin</a><a href='#lock' class='btn btn-default' data-toggle='collapse'>$lock</a>";
                                echo "<div id='pin' class='collapse'>";
                                echo"<form method='post' action='forms/processThread.php'>";
                                echo "<div class='input-group'>";
                                echo "<input name='switch' id='switch' type='hidden' value='pin'/>";
                                echo "<input name='id' id='id' type='hidden' value='$id'/>";
                                echo "<input name='pin' id='pin' type='hidden' value='$announcement'/>";
                                echo "<button type='submit'>Êtes-vous sûr?</button>";
                                echo "</div>";
                                echo "</form>";
                                echo "</div>";
                                echo "<div id='lock' class='collapse'>";
                                echo"<form method='post' action='forms/processThread.php'>";
                                echo "<div class='input-group'>";
                                echo "<input name='switch' id='switch' type='hidden' value='lock'/>";
                                echo "<input name='id' id='id' type='hidden' value='$id'/>";
                                echo "<input name='lock' id='lock' type='hidden' value='$locked'/>";
                                echo "<button type='submit'>Êtes-vous sûr?</button>";
                                echo "</div>";
                                echo "</form>";
                                echo "</div>";
                            }
                            if($_SESSION["admin"] || $authorid == $_SESSION["id"]){
                                echo "<a href='#delete' class='btn btn-default' data-toggle='collapse'>Supprimer</a>";
                                echo "<div id='delete' class='collapse'>";
                                echo"<form method='post' action='forms/processThread.php'>";
                                echo "<div class='input-group'>";
                                echo "<input name='switch' id='switch' type='hidden' value='delete'/>";
                                echo "<input name='id' id='id' type='hidden' value='$id'/>";
                                echo "<button type='submit'>Êtes-vous sûr de vouloir supprimer ce thread?</button>";
                                echo "</div>";
                                echo "</form>";
                                echo "</div>";
                            }


                        
                        
                        ?>
                    </div>
                </div>
            </div>
            <div name ="Display Commentaires" style="margin: 0 auto; width: 90%">
                <?php
                    echo"<h3>Commentaires</h3>";
                    //include  "/home/Aleaupro2020/public_html/Classes/Posts/Post.php";
                    $post_list = Post::getAll($id);
                    foreach($post_list as $post) {
                        $post->display_post($_SESSION["id"], $_SESSION["admin"]);
                    }
                ?>
            </div>
            <div name ="faire Commentaire" style="margin: 0 auto; width: 90%">
                <?php
                    if($locked == 0) {
                        echo "<div style='padding-top: 25px; width: 90%; text-align: center;'>";
                        echo "<form method='post' action='forms/processPost.php'>";
                        echo "<div class='input-group'>";
                        echo "<label>Contenu</label>";
                        echo "<textarea name='texte' id='texte'></textarea><br>";
                        echo "<input name='thread' id='thread' type='hidden' value='$id'/>";
                        echo "<input name='switch' id='switch' type='hidden' value='create'/>";
                        echo "</div>";
                        echo "<div class='input-group'>";
                        echo "<button type='submit'>Commenter</button>";
                        echo "</div>";
                        echo "</form>";
                        echo "</div>";
                    }
                    else{
                        echo "Commentaires barrés";
                    }
                
                
                
                
                ?>
            </div>
        </div>
        </div>
        <footer>
        </footer>




    <script>

    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>