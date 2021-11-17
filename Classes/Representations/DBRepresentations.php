<?php
	
	require_once "Classes/SQL/Connexion.php";

        class BDRepresentations extends Connexion {
            
            static private $conn;
            static private $isInit = false;

            public static function init() {
				
                if (!self::$isInit)
					self::$conn = self::GetConnexion();
            }

           protected static function GetAll() {
			   
				if ($result = self::$conn->query("Select * from representations")) {
               
					while($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$rows[] = $row;
					}

					$result->close();
					return $rows;
				}
           }

           static protected function getByidRepresentation($idRepresentation) {
			   
                if ($result = BDRepresentations::$conn->query("Select * from representations where idRepresentation = $idRepresentation")) {
                    
					$row = $result->fetch_array(MYSQLI_BOTH);
                    $result->close();
                    return $row;
                }
           }

			static protected function getByCustomWhere($CustomWhereQuery) {
			   
				$rows = array();
				
				

				if ($result = BDRepresentations::$conn->query("Select * from representations $CustomWhereQuery")) {
					
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
						$rows[] = $row;
					
					$result->close();
					return $rows;
				}

            }
        }
    
	BDRepresentations::init();
?>