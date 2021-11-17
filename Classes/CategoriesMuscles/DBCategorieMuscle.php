<?php
	
	require_once "Classes/SQL/Connexion.php";

        class DBCategorieMuscle extends Connexion {
            
            static private $conn;
            static private $isInit = false;

            public static function init() {
				
                if (!self::$isInit)
					self::$conn = self::GetConnexion();
            }

           protected static function GetAllCategorie() {
			   
				if ($result = DBCategorieMuscle::$conn->query("Select * from TypeMuscle")) {
               
					while($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$rows[] = $row;
					}

					$result->close();
                }
                if(isset($rows))
                return $rows;
                else
                return null;
            }  
        }
        DBCategorieMuscle::init();
?>