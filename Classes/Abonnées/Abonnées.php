<?php

    include "DBAbonnées.php";
    
    class Abonnées extends DBAbonnées {

        private $id;
        private $idClient;
        private $idEntraineur;
        private $dateInsciption;
        private $dateFin;
        
        public function __get($name) {
			
			switch ($name) { 
                
				case 'id':
                    return $this->id;
					
                case 'idClient': 
                    return $this->idClient;
			
                case 'idEntraineur': 
                    return $this->idEntraineur;

                case 'dateInsciption': 
                    return $this->dateInsciption;
                    
                case 'dateFin':
                     return $this->dateFin;
            }
        }

        public static function getAbonner($idEntraineur) {
           
            $rows = DBAbonnées::GetAbonner($idEntraineur);
                $array = null;
                if($rows == null)
                return null;
                foreach($rows as $value)
                {   $Entraineurs = new DBAbonnées();
                    
                    foreach($value as $key=>$values)
                    $Entraineurs->$key = $values;
                    $array[]=$Entraineurs;
                }
                return $array;
        }



    }
?>