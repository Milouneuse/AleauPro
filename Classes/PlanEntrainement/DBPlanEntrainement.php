<?php
	
	require_once "/home/Aleaupro2020/public_html/Classes/SQL/Connexion.php";

        class DBPlanEntrainement extends Connexion {
            
            static private $conn;
            static private $isInit = false;

            public static function init() {
				
                if (!self::$isInit)
					self::$conn = self::GetConnexion();
            }

           protected static function GetPlanByUserId($id) {
			   
				if ($result = DBPlanEntrainement::$conn->query("Select planId, nom, bio, objectif, nbJours, idClient from PlanEntrainement where idClient = $id")) {
               
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

            protected static function GetPlanByPlanId($id) {
			   
				if ($result = DBPlanEntrainement::$conn->query("Select planId, nom, bio, objectif, nbJours, idClient from PlanEntrainement where planId = $id")) {
               
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

            public function AjouterPlanEntrainement($nom,$bio, $objectif, $nbJours, $idClient){
                DBPlanEntrainement::$conn->query("insert into PlanEntrainement (nom, bio, objectif, nbJours, idClient) VALUES('$nom','$bio','$objectif','$nbJours', '$idClient')");
                $result = DBPlanEntrainement::$conn->query("select last_insert_id()");
                return $result->fetch_row()[0];
            }
            public function AjouterExercicePlan($planId,$jours, $nbSerie, $nbRep, $exerciceId, $poids){
                DBPlanEntrainement::$conn->query("insert into ExercicePlan (planId, jours, nbSerie, nbRep, exerciceId, poids) VALUES('$planId','$jours','$nbSerie','$nbRep', '$exerciceId', '$poids')");
                $result = DBPlanEntrainement::$conn->query("select last_insert_id()");
                return $result->fetch_row()[0];
            }
            public function DeletePlan($planId){
                DBPlanEntrainement::$conn->query("DELETE FROM PlanEntrainement WHERE planId = $planId");
                $result = DBPlanEntrainement::$conn->query("select last_insert_id()");
                return $result->fetch_row()[0];
            }
            public function GetIdExercice($exerciceNom){
                $result = DBPlanEntrainement::$conn->query("select ExerciceID from Exercice where ExerciceNom = '$exerciceNom'");
                return $result->fetch_row();
            }
            public function GetIdPlan(){
                $result = DBPlanEntrainement::$conn->query("SELECT planId FROM `PlanEntrainement` ORDER BY planId DESC LIMIT 1;");
                return $result->fetch_row();
            }
            public static function GetPlanExercices($planId){
                if ($result = DBPlanEntrainement::$conn->query("SELECT exercicePlanId, planId, jours, nbSerie, nbRep, exerciceId, poids FROM 'ExercicePlan' WHERE planId = $planId")) {
					while($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$rows[] = $row;
					}
					$result->close();
                }
                if(isset($rows))
                return $rows;
                else{
                echo 'noob';
                return null;
            }
        }
    }
        DBPlanEntrainement::init();
?>