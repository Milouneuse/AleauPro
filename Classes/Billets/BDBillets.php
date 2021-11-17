<?php
	
	require_once "Classes/SQL/Connexion.php";

        class BDBillets extends Connexion {
            
            static private $conn;
            static private $isInit = false;

            public static function init() {
				
                if (!self::$isInit)
					self::$conn = self::GetConnexion();
            }

           protected static function GetAll() {
			   
				if ($result = BDSpectacles::$conn->query("Select * from billets")) {
               
					while($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$rows[] = $row;
					}

					$result->close();
					return $rows;
				}
           }

           static protected function getByidBillet($idBillet) {
			   
                if ($result = BDBillets::$conn->query("Select * from billets where idBillet = $idBillet")) {
                    
					$row = $result->fetch_array(MYSQLI_BOTH);
                    $result->close();
                    return $row;
                }
           }

			static protected function getByCustomWhere($CustomWhereQuery) {
			   
				$rows = array();
				
				if ($result = BDBillets::$conn->query("Select * from billets $CustomWhereQuery")) {
					
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
						$rows[] = $row;
					
					$result->close();
					return $rows;
				}

            }
        }
    
	BDBillets::init();
?>