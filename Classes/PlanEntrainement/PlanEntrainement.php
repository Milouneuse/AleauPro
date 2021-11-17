<?php

    include "DBPlanEntrainement.php";
    
    class PlanEntrainement extends DBPlanEntrainement {

        private $planId;
        private $nom;
        private $bio;
        private $objectif;
        private $nbJours;
        private $idClient;
        private $exercicePlanId;
        private $jours;
        private $nbSerie;
        private $nbRep;
        private $exerciceId;
        private $poids;

        public function __get($name) {
			
			switch ($name) { 
                
				case 'planId':
                    return $this->planId;
					
                case 'nom': 
                    return $this->nom;
			
                case 'bio': 
                    return $this->bio;

                case 'objectif': 
                    return $this->objectif;
                    
                case 'nbJours':
                     return $this->nbJours;
                
                case 'idClient':
                    return $this->idClient;
                case 'exercicePlanId':
                    return $this->exercicePlanId;
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

        public static function getPlanByUserId($idClient) {
           
            $rows = DBPlanEntrainement::GetPlanByUserId($idClient);
                $array = null;
                if($rows == null)
                return null;
                foreach($rows as $value)
                {   $Note = new DBPlanEntrainement();
                    
                    foreach($value as $key=>$values)
                    $Note->$key = $values;
                    $array[]=$Note;
                }
                return $array;
        }

        public static function getPlanByPlanId($idPlan) {
           
            $rows = DBPlanEntrainement::GetPlanByPlanId($idPlan);
                $array = null;
                if($rows == null)
                return null;
                foreach($rows as $value)
                {   $Note = new DBPlanEntrainement();
                    
                    foreach($value as $key=>$values)
                    $Note->$key = $values;
                    $array[]=$Note;
                }
                return $array;
        }
        public static function getPlanExercices($planId) {
            $rows = DBPlanEntrainement::GetPlanExercices($planId);
                $array = null;
                if($rows == null)
                return null;
                foreach($rows as $value)
                {   $Note = new DBPlanEntrainement();
                    
                    foreach($value as $key=>$values)
                    $Note->$key = $values;
                    $array[]=$Note;
                }
                return $array;
        }
        public function ajouterPlanEntrainement($nom,$bio, $objectif, $nbJours, $idClient){
            $TDG = new DBPlanEntrainement();
            $res = $TDG->AjouterPlanEntrainement($nom,$bio, $objectif, $nbJours, $idClient);
            $TDG = null;
            if(!$res)
            {
                return false;
            }
            return true;
        }
        public function ajouterExercicePlan($planId,$jours, $nbSerie, $nbRep, $exerciceId, $poids){
            $TDG = new DBPlanEntrainement();
            $res = $TDG->AjouterExercicePlan($planId,$jours, $nbSerie, $nbRep, $exerciceId, $poids);
            $TDG = null;
            if(!$res)
            {
                return false;
            }
            return true;
        }
        public function deletePlan($planId){
            $TDG = new DBPlanEntrainement();
            $res = $TDG->DeletePlan($planId);
            $TDG = null;
            if(!$res)
            {
                return false;
            }
            return true;
        }

        public function getIdExercice($exerciceNom){
            $TDG = new DBPlanEntrainement();
            $res = $TDG->GetIdExercice($exerciceNom);
            return $res[0];
        }
        public function getIdPlan(){
            $TDG = new DBPlanEntrainement();
            $res = $TDG->GetIdPlan();
            return $res[0];
        }
    }
?>