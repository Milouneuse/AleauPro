<?php
  session_start();
  include "Classes/Thread/thread.php";
  //include "Classes/Utilisateurs/Clients.php";
  $author = $_SESSION["username"];
  //get user id
  $authorobject = new Clients();
  $authorid = $_SESSION["id"];
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> forum </title>
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
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
            <div style="text-align: center; font-weight: bold; padding-top: 5%;">
                <h1>Créer un Thread</h1>
            </div>
            <div style='padding-top: 25px; width: 90%; text-align: center;'>
                <form method="post" action="forms/processThread.php">
                    <div class="input-group">
                        
                        <input name='locked' id='locked' type='hidden' value='0'/>
                        <input name='switch' id='switch' type='hidden' value='create'/>
                        <input name='announcement' id='announcement' type='hidden' value='0'/>
                        <label>Titre</label>
                        <br>
                        <input type="text" id="titre" name="titre"/><br>
                    </div>
                    <div class="input-group">
                        <label>Contenu</label>
                        <textarea name="texte" id="texte"></textarea><br>
                    </div>
                    <div class="input-group">
                        <label>Catégorie</label>
                        <select name="categorie" id="categorie">
                            <?php
                                include "Classes/Categories/Categories.php";
                                $cat_list = Categories::getAll();
                                foreach($cat_list as $cat) {
                                    $cat->select_cat();
                                }
                            ?>
                        </select>
                    </div>
                    <?php

                    if(isset($_SESSION['admin'])) {
                        echo "<div class='input-group'>";
                        echo "<label for='locked'>Fermé</label>";
                        echo "<input type='checkbox' id='locked' name='locked' value='1'>";
                        echo "</div>";
                        echo "<div class='input-group'>";
                        echo "<label for='announcement'>Annonce</label>";
                        echo "<input type='checkbox' id='announcement' name='announcement' value='1'>";
                        echo "</div>";
                    }
                    ?>
                    <div class="input-group">
                        <button type="submit">Créer</button>
                    </div>
                </form>
            </div>
            
        </div>
        </div>
        <footer>
        </footer>




    <script>

    </script>
    </body>
</html>