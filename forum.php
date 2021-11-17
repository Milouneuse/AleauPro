<?php session_start();

if(!isset($_SESSION["username"]))
    header("location: Login/login.php");

if(isset($_GET["catID"])) {
    $id = $_GET["catID"];
    $nom = $_GET["cat"];
}
else {
    $nom = "tous";
    $id = 0;
}

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
                <h1>Bienvenu sur le forum d'AleauPro</h1>
            </div>
            <div class="row">
                <div name="categories et threads" class="col-sm-8 mb-4">
                <h3>Cliquez sur une catégorie pour voir uniquement les threads dans cette catégorie.</h3>
                <h5>Catégorie courrante: <?php echo "'$nom'"?></h5>
                    <div name= "categories" style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; padding: 10px; text-align: center;">
                        <?php
                            include "Classes/Categories/Categories.php";
                            $cat_list = Categories::getAll();
                            foreach($cat_list as $cat) {
                                $cat->display_cat($id);
                            }
                        ?>
                    </div>
                    <div name= "threads" style="margin: 0 auto; width: 90%">
                        <?php
                            include "Classes/Thread/thread.php";
                            $thread_list = Thread::getAll($id,0);
                            foreach($thread_list as $thread) {
                                $thread->display_thread();
                            }
                        ?>
                    </div>
                </div>
                <div name="creation et announcements" class="col-sm-4 mb-4" style="width: 100%">
                    <div name= "Creation Thread" style= "margin: auto; border: 1px solid black;">
                            <button onclick="location.href = 'createThread.php'" style="width: 100%">Créer un Thread</button>
                    </div>
                    <div name="Annonces" style="margin: 0 auto; width: 90%; text-align: center">
                        <h3>Annonces des admins</h3>
                        <?php
                            $thread_list = Thread::getAll(0,1);
                            foreach($thread_list as $thread) {
                                $thread->display_thread();
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <footer>
        </footer>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>

    </script>
    </body>
</html>