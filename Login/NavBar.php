<body>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<ul>
		<li><a href="./../index.php#"><img src="./../image/aleauprosansbackground.png" style="height:20px; padding-bottom:0px;"> </img></a> </li>
		<?php if(isset($_SESSION['username'])) {
			echo '<li class="dropdown">';
			echo '<a href="javascript:void(0)" class="dropbtn"> ' . $_SESSION['username'] .'</a>';
			echo '<div class="dropdown-content">';
			echo"<a href='modifier.php'>Modifier les informations</a>";
			echo"<a href='#'>Vos plans</a>";
			echo"<a href='#'>Devenir membre</a>";
			echo '<a href="logout.php">Déconnection</a>';
			echo'</div>';
		echo '</li>';
			
		} else {
			echo
			'<li> <a href="./login.php">Connection</a> </li>';
		}?>
		<li><a href="./../Recettes.php"> Recettes </a></li>
		<li><a href="./../entraineur.php#"> Entraîneurs </a></li>
		<li><a href="./../forum.php"> Forum </a></li>
		<li><a href="mailto:aleaupro.help@gmail.com"> Contact </a></li>
		<?php if(isset($_SESSION["admin"]))
			echo
			'<li><a href="AjouterSpectacle.php">Ajouter Spectacle</a> </li>
			<li> <a href="AjouterRepresentation.php">Ajouter Representation</a> </li>';
			
		?>		
		<div class="search-container">
    <form id="navSearch" action="/Recherche.php.php">
      <input id="navSearch" type="text" placeholder="Rechercher" name="search">
      <button type="submit" id="navBtn"><i class="fa fa-search"></i></button>
    </form>
  </div>


</body>