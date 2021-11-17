<?php
	
	require_once "Classes/SQL/Connexion.php";

        class DBAbonnées extends Connexion {
            
            static private $conn;
            static private $isInit = false;

            public static function init() {
				
                if (!self::$isInit)
					self::$conn = self::GetConnexion();
            }

       protected static function GetAbonner($idEntraineur) {
        if ($result = DBAbonnées::$conn->query("Select * from abonnementEntraineur where idEntraineur = $idEntraineur")) {
            {
            while($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                $rows[] = $row;
            }
            $result->close();
            }
            if(isset($rows))
            return $rows;
        }
        return null;
        
   }
        }
        DBAbonnées::init();
?>