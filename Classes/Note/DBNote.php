<?php
	
	require_once "Classes/SQL/Connexion.php";

        class DBNote extends Connexion {
            
            static private $conn;
            static private $isInit = false;

            public static function init() {
				
                if (!self::$isInit)
					self::$conn = self::GetConnexion();
            }

           protected static function GetCommentaireIdEntraineur($id) {
			   
				if ($result = DBNote::$conn->query("Select * from rating where idEntraineur = $id")) {
               
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
        DBNote::init();
?>