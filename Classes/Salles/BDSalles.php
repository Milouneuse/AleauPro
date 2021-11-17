<?php
	
	require_once "Classes/SQL/Connexion.php";

        class BDSalles extends Connexion {
            
            static private $conn;
            static private $isInit = false;

            public static function init() {
				
                if (!self::$isInit)
					self::$conn = self::GetConnexion();
            }

           protected static function GetAll() {
			   
				if ($result = BDSalles::$conn->query("Select * from salles")) {
               
					while($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$rows[] = $row;
					}

					$result->close();
					return $rows;
				}
           }

           static protected function getByidSalle($idSalle) {
			   
                if ($result = BDSalles::$conn->query("Select * from salles where idSalle = $idSalle")) {
                    
					$row = $result->fetch_array(MYSQLI_BOTH);
                    $result->close();
                    return $row;
                }
           }

			static protected function getByCustomWhere($CustomWhereQuery) {
			   
				$rows = array();
				
				if ($result = BDSalles::$conn->query("Select * from salles $CustomWhereQuery")) {
					
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
						$rows[] = $row;
					
					$result->close();
					return $rows;
				}

            }
        }
    
	BDSalles::init();
?>