<?php

    include "DBCategorieMuscle.php";
    
    class CategorieMuscle extends DBCategorieMuscle {

        private $MuscleID;
        private $MuscleNom;
        
        public function __get($name) {
			
			switch ($name) { 
                
				case 'MuscleID':
                    return $this->MuscleID;
					
                case 'MuscleNom': 
                    return $this->MuscleNom;
            }
        }

        public static function getAllCategorie() {
           
            $rows = DBCategorieMuscle::GetAllCategorie();
                $array = null;
                if($rows == null)
                return null;
                foreach($rows as $value)
                {   $Note = new DBCategorieMuscle();
                    
                    foreach($value as $key=>$values)
                    $Note->$key = $values;
                    $array[]=$Note;
                }
                return $array;
        }
    }
?>