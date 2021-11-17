<?php 
require_once "/home/Aleaupro2020/public_html/Classes/SQL/Connexion.php";

class DBExercicePlan extends Connexion {
            
    static private $conn;
    static private $isInit = false;

    public static function init() {
        
        if (!self::$isInit)
            self::$conn = self::GetConnexion();
    }
    protected static function GetAllExerciceDay($planId, $jours) {
			   
        if ($result = DBExercicePlan::$conn->query("Select nbSerie, nbRep, exerciceId, poids from ExercicePlan where planId = $planId AND jours = $jours")) {
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



}







DBExercicePlan::init();





?>