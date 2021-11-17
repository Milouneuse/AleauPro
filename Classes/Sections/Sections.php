<?php

    include "BDSections.php";
    
    class Sections extends BDSections {

        private $idSection;
        private $fm_Prix;
        private $capacite;
        private $couleur;
        private $idSalle;
        
        public function __get($name) {
			
			switch ($name) { 
                
				case 'idSection':
                    return $this->idSection;
					
                case 'fm_Prix': 
                    return $this->fm_Prix;
			
                case 'Capacite': 
                    return $this->capacite;
					
                case 'Couleur': 
                    return $this->couleur;	
					
                case 'idSalle': 
                    return $this->idSalle;
            }
        }

        public function getByID($id) {
           
            $rows = BDSections::getByidSection($id);
            
			if ($rows == null)
				printf("Erreur, retourne Null");
                
			else {
				
				$this->idSection = $rows["idSection"];
                $this->fm_Prix = $rows["fm_Prix"];
                $this->capacite = $rows["Capacite"];
                $this->couleur = $rows["Couleur"];
                $this->idSalle = $rows["idSalle"];
            }
        }

        public function AfficherSection() {
			
            echo ("$this->idSection , $this->fm_Prix , $this->capacite , $this->couleur , $this-> idSalle");
        }

        static public function SearchByAll($arrayDeParam) {

            if($arrayDeParam !== null)
            if (count($arrayDeParam) <=3)  {
                
                $query = "";
                
                if(array_key_exists("Couleur", $arrayDeParam))
                if (strlen($arrayDeParam["Couleur"]) !== 0)
					$query .= "$query Couleur LIKE '%".$arrayDeParam["Couleur"]."%' ";
                
                    if(array_key_exists("Capacite", $arrayDeParam))
				if (strlen($arrayDeParam["Capacite"]) !== 0)
					$query .= "$query Capacite <= ".$arrayDeParam["Capacite"];
                
                    if(array_key_exists("fm_prix", $arrayDeParam))
				if (strlen($arrayDeParam["fm_Prix"]) !== 0)
					$query .= "$query fm_Prix <= ".$arrayDeParam["fm_Prix"];
                
                if(array_key_exists("idSalle", $arrayDeParam))
				if (strlen($arrayDeParam["idSalle"]) !== 0)
					$query .= "$query idSalle = ".$arrayDeParam["idSalle"];

                if(strlen($query) !==0)
                    $rows = BDSections::getByCustomWhere("WHERE $query");
				
                else
                    $rows = BDSections::GetAll();

                $array = null;
				
                foreach($rows as $value) {   
				
					$Section = new Sections();
					
                    foreach($value as $key=>$values)
                        $Section->$key = $values;
						
                    $array[] = $Section;
                }
            
                return $array;
            }
        }
    }
?>