<?php

    include "BDSalles.php";
    
    class Salles extends BDSalles {

        private $idSalle;
        private $adresse;
        private $capacite;
        
        public function __get($name) {
			
			switch ($name) { 
                
				case 'idSalle':
                    return $this->idSalle;
					
                case 'Adresse': 
                    return $this->adresse;
			
                case 'Capacite': 
                    return $this->capacite;
            }
        }

        public function getByID($id) {
           
            $rows = BDSalles::getByidSalle($id);
            
			if ($rows == null)
				printf("Erreur, retourne Null");
                
			else {
				
				$this->idSalle = $rows["idSalle"];
                $this->adresse = $rows["Adresse"];
                $this->capacite = $rows["Capacite"];
            }
        }

        public function AfficherSalle() {
			
            echo ("$this->idSalle , $this->adresse , $this->capacite");
        }

        static public function SearchByAll($arrayDeParam = null) {

            if ($arrayDeParam !== null && count($arrayDeParam) === 3) {
                
                $IsValide = array_key_exists("Adresse", $arrayDeParam);

                if ($IsValide)
					$IsValide = array_key_exists("Capacite", $arrayDeParam);
               
                if (!$IsValide)
					return null;
				
                $query = "";
				
                if (strlen($arrayDeParam["Adresse"]) !== 0)
					$query .= "$query Adresse LIKE '%".$arrayDeParam["Adresse"]."%' ";
				
				if (strlen($arrayDeParam["Capacite"]) !== 0)
					$query .= "$query Capacite <= ".$arrayDeParam["Capacite"];

                if(strlen($query) !==0)
                    $rows = BDSalles::getByCustomWhere("WHERE $query");
				
                else
                    $rows = BDSalles::GetAll();

                $array = null;
				
                foreach($rows as $value) {   
				
					$Salle = new Salles();
					
                    foreach($value as $key=>$values)
                        $Salle->$key = $values;
						
                    $array[] = $Salle;
                }
            
                return $array;
            }
            else if($arrayDeParam == null || count($arrayDeParam) == 0) 
            {
                $rows = BDSalles::GetAll();
                $array = null;
                foreach($rows as $value)
                {   $Salle = new Salles();
                    
                    foreach($value as $key=>$values)
                        $Salle->$key = $values;
                    $array[]=$Salle;
                }
            
                return $array;
            }
        }
    }
?>