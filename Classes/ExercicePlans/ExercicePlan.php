<?php

    include "DBExercicePlan.php";
    
    class ExercicePlan extends DBExercicePlan {

        private $exercicePlanId;
        private $planId;
        private $jours;
        private $nbSerie;
        private $nbRep;
        private $exerciceId;
        private $poids;
        
        public function __get($name) {
			
			switch ($name) { 
                
				case 'exercicePlanId':
                    return $this->exercicePlanId;
					
                case 'planId': 
                    return $this->planId;
			
                case 'jours': 
                    return $this->jours;

                case 'nbSerie': 
                    return $this->nbSerie;
                    
                case 'nbRep':
                     return $this->nbRep;
                case 'exerciceId':
                    return $this->exerciceId;
                case 'poids':
                    return $this->poids;
            }
        }

        public static function getAllExerciceDay($planId, $jours) {
           
            $rows = DBExercicePlan::GetAllExerciceDay($planId, $jours);
                $array = null;
                if($rows == null)
                return null;
                foreach($rows as $value)
                {   $Entraineurs = new DBExercicePlan();
                    
                    foreach($value as $key=>$values)
                    $Entraineurs->$key = $values;
                    $array[]=$Entraineurs;
                }
                return $array;
        }

    }
?>