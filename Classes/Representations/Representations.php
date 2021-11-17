<?php

    include "DBRepresentations.php";
    
    class Representations extends BDRepresentations {

        private $idRepresentation;
        private $idSpectacle;
        private $date;
        private $idSalle;
        
        public function __get($name) {
			
			switch ($name) { 
                
				case 'idRepresentation':
                    return $this->idRepresentation;
					
                case 'idSpectacle': 
                    return $this->idSpectacle;
			
                case 'Date': 
                    return $this->date;
			
                case 'idSalle': 
                    return $this->idSalle;
            }
        }

        public function getByID($id) {
           
            $rows = BDRepresentations::getByidRepresentation($id);
            
			if ($rows == null)
				printf("Erreur, retourne Null");
                
			else {
				
				$this->idRepresentation = $rows["idRepresentation"];
                $this->idSpectacle = $rows["idSpectacle"];
                $this->date = $rows["Date"];
                $this->idSalle = $rows["idSalle"];
            }
        }

        public function AfficherRepresentation() {
			
            echo ("$this->idRepresentation , $this->idSpectacle , $this->Date , idSalle");
        }

        static public function SearchByAll($arrayDeParam) {
            if($arrayDeParam !== null)
            if (count($arrayDeParam) <=3) {
                $query = "";
                
                if(array_key_exists("idSpectacle", $arrayDeParam))
                if (strlen($arrayDeParam["idSpectacle"]) !== 0)
                    $query .= "$query idSpectacle = ".$arrayDeParam["idSpectacle"];
                    
				if(array_key_exists("Date", $arrayDeParam))
				if (strlen($arrayDeParam["Date"]) !== 0)
					$query .= "$query Date = ".$arrayDeParam["Date"];
                
                    if(array_key_exists("idSalle", $arrayDeParam))
				if (strlen($arrayDeParam["idSalle"]) !== 0)
					$query .= "$query idSalle = ".$arrayDeParam["idSalle"];

                if(strlen($query) !==0)
                    $rows = BDRepresentations::getByCustomWhere("WHERE $query");
				
                else
                    $rows = BDRepresentations::GetAll();

               
                $array = null;
				
                foreach($rows as $value) {   
				
					$Representation = new Representations();
					
                    foreach($value as $key=>$values)
                        $Representation->$key = $values;
						
                    $array[] = $Representation;
                }
            
                return $array;
            }
          
        }
    }
?>