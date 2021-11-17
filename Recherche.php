<html>

<body >
<link rel="stylesheet" href="css.css"/>

<?php include "NavBar.php"; ?>
    
	
   
<div class="articleHolder">
    <?php
		include "BarRecherche.php"; 
		include_once "Classes/Categories/Categories.php";
		include "Classes/Spectacles/Spectacles.php";
    

        // Chequer la longueur de chaque poste Et faire une recherche différente pour chaques ! 
		if(isset($_POST["Categories"]) &&isset( $_POST["NomSpectacle"]) &&isset($_POST["NomArtiste"]) )
		{	
		$NomSpectacle = $_POST["NomSpectacle"];
        $NomArtiste = $_POST["NomArtiste"];
       
      

      	$NomArtiste = str_replace("'","\'",$NomArtiste);
        $NomSpectacle = str_replace("'","\'",$NomSpectacle);
        
        $NomArtiste =str_replace('"',"\"",$NomArtiste);
        $NomSpectacle =str_replace('"',"\"",$NomSpectacle);
      

        	$array["idCategorie"] = $_POST["Categories"];
        	$array["NomSpectacle"] = $NomSpectacle;
			$array["NomArtiste"] = $NomArtiste;
			$SpectaclesArray = array();
			$SpectacleArray = Spectacles::SearchByAll($array);
		}
        $CategoriesArray = Categories::getAllToArray();
		
        if(isset($SpectacleArray))
			foreach($SpectacleArray as $values)
			{
			   
				echo "
					<article>
					
						<h1> $values->nomSpectacle </h1>
						<div style='text-align: center;'>
						<img style='widht:200;height:200;align:center;'src='posters/$values->nomImage'>
						</div>
						<p> ";  if (strlen($values->nomArtiste) !== 0)
							echo "Artiste: $values->nomArtiste <br/> ";
							echo "
							Genre:".$CategoriesArray[$values->idCategorie]." <br/>
							$values->Description 
						</p>
						
						<aside>
							
							
							<aside> <a href='Spectacle.php?id=$values->idSpectacle' class='bouton'>Plus d'info</a> </aside>
							
						</aside>
					
					</article>
				";
		
			}
	   else
	   echo "
					<article>
				
						<p></p>
						
					
					</article>
				"
    ?>
	</div>
<script src="achat.js"></script>
</body>
</html>