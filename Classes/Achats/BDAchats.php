<?php
	
	require_once "Classes/SQL/Connexion.php";

        class BDAchats extends Connexion {
            
            static private $conn;
            static private $isInit = false;

            public static function init() {
				
                if (!self::$isInit)
					self::$conn = self::GetConnexion();
            }

           protected static function GetAll() {
			   
				if ($result = BDSpectacles::$conn->query("Select * from achats")) {
               
					while($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$rows[] = $row;
					}

					$result->close();
					return $rows;
				}
           }

           static protected function getByidAchat($idAchat) {
			   
                if ($result = BDAchats::$conn->query("Select * from achats where idAchat = $idAchat")) {
                    
					$row = $result->fetch_array(MYSQLI_BOTH);
                    $result->close();
                    return $row;
                }
           }

			static protected function getByCustomWhere($CustomWhereQuery) {
			   
				$rows = array();
				
				if ($result = BDAchats::$conn->query("Select * from achats $CustomWhereQuery")) {
					
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
						$rows[] = $row;
					
					$result->close();
					return $rows;
				}

            }
        }
    
	BDAchats::init();
?>