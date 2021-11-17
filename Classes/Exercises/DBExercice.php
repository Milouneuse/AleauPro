<?php
	
	require_once "Classes/SQL/Connexion.php";

        class DBExercice extends Connexion {
            
            static private $conn;
            static private $isInit = false;

            public static function init() {
				
                if (!self::$isInit)
					self::$conn = self::GetConnexion();
            }

           protected static function GetAllExercise() {
			   
				if ($result = DBExercice::$conn->query("Select * from Exercice")) {
               
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

            protected static function GetNameExerciceById($id) {    
                    if ($result = DBExercice::$conn->query("SELECT * FROM Exercice WHERE ExerciceID=$id")) {
               
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
        DBExercice::init();
?>