<?php
	
	require_once "Classes/SQL/Connexion.php";

        class BDAchatReels extends Connexion {
            
            static private $conn;
            static private $isInit = false;

            public static function init() {
				
                if (!self::$isInit)
					self::$conn = self::GetConnexion();
            }

           protected static function GetAll() {
			   
				if ($result = BDAchatReels::$conn->query("Select * from achatreels")) {
               
					while($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$rows[] = $row;
					}

					$result->close();
					return $rows;
				}
           }

           static protected function getByidAchatReel($idAchatReel) {
			   
                if ($result = BDAchatReels::$conn->query("Select * from achatreels where idAchatReel = $idAchatReel")) {
                    
					$row = $result->fetch_array(MYSQLI_BOTH);
                    $result->close();
                    return $row;
                }
           }

			static protected function getByCustomWhere($CustomWhereQuery) {
			   
				$rows = array();
				
				if ($result = BDAchatReels::$conn->query("Select * from achatreels $CustomWhereQuery")) {
					
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
						$rows[] = $row;
					
					$result->close();
					return $rows;
				}

			}
			
			static protected function addAchatReel($date,$idSection,$idRep,$qte,$idClient){
				echo $date;
				
				$result = BDAchatReels::$conn->query("INSERT INTO achatreels (Quantite,idSection,idRepresentation,date,idClient) values
				($qte,$idSection,$idRep,'$date',$idClient)");

				 echo BDAchatReels::$conn->error;
			}
        }
    
	BDAchatReels::init();
?>