<?php
	
	require_once "/home/Aleaupro2020/public_html/Classes/SQL/Connexion.php";

        class DBEntraineurs extends Connexion {
            
            static private $conn;
            static private $isInit = false;

            public static function init() {
				
                if (!self::$isInit)
					self::$conn = self::GetConnexion();
            }

            protected static function updateecole($id, $ecole){
                $ecol = mysqli_real_escape_string(Connexion::getLink(), $ecole);
                DBEntraineurs::$conn->query("update entraineurInfo set ecole = '$ecol' where id = $id");
            }

            protected static function updatetravail($id, $travail){
                $travai = mysqli_real_escape_string(Connexion::getLink(), $travail);
                DBEntraineurs::$conn->query("update entraineurInfo set travail = '$travai' where id = $id");
            }

            protected static function updatebio($id, $bio){
                $bi = mysqli_real_escape_string(Connexion::getLink(), $bio);
                DBEntraineurs::$conn->query("update entraineurInfo set bio = '$bi' where id = $id");
            }
            protected static function follo($userid,$entraineurid){
                DBEntraineurs::$conn->query("insert into abonnementEntraineur(idEntraineur, idClient) VALUES($entraineurid,$userid)");
            }
            protected static function unfollo($userid,$entraineurid){
                DBEntraineurs::$conn->query("delete from abonnementEntraineur WHERE idEntraineur = $entraineurid AND idClient = $userid");
            }

            protected static function getfollow($userid, $entraineurid){
                $query = "SELECT * FROM abonnementEntraineur WHERE idEntraineur = $entraineurid and idClient = $userid";
                $rows = array();
                if($result = self::$conn->query($query)){
                    return $result;
                }
            }

           protected static function GetListCoach($idCategorie) {
			   
				if ($result = DBEntraineurs::$conn->query("Select * from view_entraineur where categorie = $idCategorie ORDER BY NOTE DESC")) {
               
					while($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$rows[] = $row;
					}

					$result->close();
                }
                if(!isset($rows))
                 {
            if($result = DBEntraineurs::$conn->query("Select * from view_entraineur"))
            {
                while($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                $rows[] = $row;
            }
            $result->close();
            }
           
        }
        return $rows;
           }

       protected static function GetAbonner($idEntraineur) {
			   
        if ($result = DBEntraineurs::$conn->query("Select * from abonnementEntraineur where idEntraineur = $idEntraineur")) {
            {
            while($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                $rows[] = $row;
            }
            $result->close();
            }
        }
        return $rows;
   }

           static protected function GetByidEntraineur($idEntraineur) {
                if ($result = DBEntraineurs::$conn->query("Select * from view_entraineur_Individual where id = $idEntraineur")) {
					$row = $result->fetch_array(MYSQLI_BOTH);
                    $result->close();
                    return $row;
                }
           }
        }
        DBEntraineurs::init();
?>