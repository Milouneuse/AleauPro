<?php 

session_start();
if(!isset($_SESSION["username"]))
header("location: Login/login.php")

?>

<html>
<head>
	<title>Statistiques</title>
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
    <div id="portailUser">
    <div class="menu-info">
     <h3 style="grid-column: 1 / 8 span;"> Statistiques de <?php echo $_SESSION["username"]; ?> </h3>
     <div> 
        <p> 0 <br> plans complétés </p>
        <div style="background-image: url('image/icon/icon1.PNG');  background-repeat: no-repeat; background-size: cover;"> </div>
     
     </div>
     <div> 
        <p> 0 <br> visites au gym </p>
        <div style="background-image: url('image/icon/icon2.PNG');  background-repeat: no-repeat; background-size: cover;"> </div>
    
     </div>
     <div> 
        <p> 0 <br> récompenses accumulées </p>
        <div style="background-image: url('image/icon/icon3.PNG');  background-repeat: no-repeat; background-size: cover;"> </div>
     
     </div>
     <div> 
        <p> 0 <br> recettes certifiées </p>
        <div style="background-image: url('image/icon/ison4.PNG');  background-repeat: no-repeat; background-size: cover;"> </div>
     
     </div>
     <div> 
        <p> 0 <br> jours actifs chez AleauPro </p>
        <div style="background-image: url('image/icon/icon6.PNG');  background-repeat: no-repeat; background-size: cover;"> </div>
     </div>
     </div>
     </div>
</div>
</body>