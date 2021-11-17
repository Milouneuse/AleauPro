<?php

    include "BDBillets.php";
    
    class Billets extends BDBillets {

        private $idBillet;
        private $prix_de_base;
        private $idRepresentation;
        private $idSpectacle;
        private $idSection;
        private $idSalle;
        
        public function __get($name) {
			
			switch ($name) { 
                
				case 'idBillet':
                    return $this->idBillet;
					
                case 'prix_de_base': 
                    return $this->prix_de_base;
			
                case 'idRepresentation': 
                    return $this->idRepresentation;
			
                case 'idSpectacle': 
                    return $this->idSpectacle;
			
                case 'idSection': 
                    return $this->idSection;
			
                case 'idSalle': 
                    return $this->idSalle;
            }
        }

        public function getByID($id) {
           
            $rows = BDBillets::getByidBillet($id);
            
			if ($rows == null)
				printf("Erreur, retourne Null");
                
			else {
				
				$this->idBillet = $rows["idBillet"];
                $this->prix_de_base = $rows["prix_de_base"];
                $this->idRepresentation = $rows["idRepresentation"];
                $this->idSpectacle = $rows["idSpectacle"];
                $this->idSalle = $rows["idSalle"];
                $this->idSection = $rows["idSection"];
            }
        }

        public function AfficherBillet() {
			
            echo ("$this->idBillet , $this->prix_de_base , $this->idRepresentation , $this->idSpectacle , $this->idSalle , $this->idSection");
        }

        static public function SearchByAll($arrayDeParam) {

            if ($arrayDeParam !== null && count($arrayDeParam) === 3) {
                
                $IsValide = array_key_exists("prix_de_base", $arrayDeParam);

                if ($IsValide)
					$IsValide = array_key_exists("idRepresentation", $arrayDeParam);

                if ($IsValide)
					$IsValide = array_key_exists("idSpectacle", $arrayDeParam);

                if ($IsValide)
					$IsValide = array_key_exists("idSalle", $arrayDeParam);

                if ($IsValide)
					$IsValide = array_key_exists("idSection", $arrayDeParam);
               
                if (!$IsValide)
					return null;
				
                $query = "";
				
                if (strlen($arrayDeParam["prix_de_base"]) !== 0)
					$query .= "$query prix_de_base  <= ".$arrayDeParam["prix_de_base"];
				
				if (strlen($arrayDeParam["idRepresentation"]) !== 0)
					$query .= "$query idRepresentation = ".$arrayDeParam["idRepresentation"];
				
				if (strlen($arrayDeParam["idSpectacle"]) !== 0)
					$query .= "$query idSpectacle = ".$arrayDeParam["idSpectacle"];
				
				if (strlen($arrayDeParam["idSalle"]) !== 0)
					$query .= "$query idSalle = ".$arrayDeParam["idSalle"];
				
				if (strlen($arrayDeParam["idSection"]) !== 0)
					$query .= "$query idSection = ".$arrayDeParam["idSection"];

                if(strlen($query) !==0)
                    $rows = BDBillets::getByCustomWhere("WHERE $query");
				
                else
                    $rows = BDBillets::GetAll();

                $array = null;
				
                foreach($rows as $value) {   
				
					$Billet = new Billets();
					
                    foreach($value as $key=>$values)
                        $Billet->$key = $values;
						
                    $array[] = $Billet;
                }
            
                return $array;
            }
        }
    }
?>