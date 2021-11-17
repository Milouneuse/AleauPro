<?php

    include "DBExercice.php";
    
    class Exercice extends DBExercice {

        private $ExerciceID;
        private $ExerciceVideoID;
        private $ExerciseImage;
        private $ExerciceNom;
        private $ExerciceDescription;
        private $ExerciceGym;
        private $TypeMuscle;

        public function __get($name) {
			
			switch ($name) { 
                
				case 'ExerciceID':
                    return $this->ExerciceID;
					
                case 'ExerciceVideoID': 
                    return $this->ExerciceVideoID;
			
                case 'ExerciseImage': 
                    return $this->ExerciseImage;

                case 'ExerciceNom': 
                    return $this->ExerciceNom;
                    
                case 'ExerciceDescription':
                     return $this->ExerciceDescription;
                
                case 'ExerciceGym':
                    return $this->ExerciceGym;

                case 'TypeMuscle':
                    return $this->TypeMuscle;
            }
        }

        public static function getAllExercise() {
           
            $rows = DBExercice::GetAllExercise();
                $array = null;
                if($rows == null)
                return null;
                foreach($rows as $value)
                {   $Note = new DBExercice();
                    
                    foreach($value as $key=>$values)
                    $Note->$key = $values;
                    $array[]=$Note;
                }
                return $array;
        }
        public static function getNameExerciceById($id) {
           
            $rows = DBExercice::GetNameExerciceById($id);
            $array = null;
            if($rows == null)
            return null;
            foreach($rows as $value)
            {   $Note = new DBExercice();
                
                foreach($value as $key=>$values)
                $Note->$key = $values;
                $array[]=$Note;
            }
            return $array;
        }
    }
?>