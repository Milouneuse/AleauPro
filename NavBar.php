<body>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<ul>
		<li><a href="index.php#"><img src="image/aleauprosansbackground.png" style="height:20px; padding-bottom:0px;"> </img></a> </li>
		<?php if(isset($_SESSION['username'])) {
			echo '<li class="dropdown">';
			echo '<a href="javascript:void(0)" class="dropbtn"> ' . $_SESSION['username'] .'</a>';
			echo '<div class="dropdown-content">';
			echo"<a href='Login/modifier.php'>Modifier les informations</a>";
			echo"<a href='statistique.php'> Statistiques</a>";
			echo"<a href='plans.php'>Vos plans</a>";
			if(!isset($_SESSION["membre"]))
			echo"<a href='abonnement.php'>Devenir membre</a>";
			echo '<a href="Login/logout.php">Déconnection</a>';
			echo'</div>';
		echo '</li>';
			
		} else {
			echo
			'<li> <a href="Login/login.php">Connection</a> </li>';
		}?>
		<li><a href="Recettes.php"> Recettes </a></li>
		<li><a href="entraineur.php#"> Entraîneurs </a></li>
		<li><a href="forum.php"> Forum </a></li>
		<li><a href="mailto:aleaupro.help@gmail.com"> Contact </a></li>		
		<div class="search-container">
    <form style="margin-bottom:4px;"action="/Recherche.php.php">
      <input type="text" placeholder="Rechercher" name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>


</body>