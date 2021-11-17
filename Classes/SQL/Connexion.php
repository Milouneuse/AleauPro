
<?php

class Connexion{


static private $dbName = 'dbequipe01';
static private $dbuser = 'equipe01'; // Devra changer
static private $dbpass = 'in9vest01'; // devra changer
static private $dbhost = '167.114.152.54'; // Devra changer pour l'adresse du serveur sur lequel le projet est!


static public function GetConnexion()
{
    $conn = new mysqli(Connexion::$dbhost,Connexion::$dbuser,Connexion::$dbpass,Connexion::$dbName);
    return $conn;
}

static public function getLink()
{
    return mysqli_connect(Connexion::$dbhost, Connexion::$dbuser, Connexion::$dbpass,Connexion::$dbName);
}
}
?>
